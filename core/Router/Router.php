<?php

class Router
{
    protected static $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];
    protected static $namedRoutes = [];
    protected static $reservedWords = ['create', 'edit'];
    protected static $middlewareGroup = [];

    public static function get($uri, $action)
    {
        self::addRoute('GET', $uri, $action);
        return new RouteRegister('GET', self::normalize($uri), $action);
    }
    
    public static function post($uri, $action)
    {
        self::addRoute('POST', $uri, $action);
        return new RouteRegister('POST', self::normalize($uri), $action);
    }

    public static function put($uri, $action)
    {
        self::addRoute('PUT', $uri, $action);
        return new RouteRegister('PUT', self::normalize($uri), $action);
    }

    public static function delete($uri, $action)
    {
        self::addRoute('DELETE', $uri, $action);
        return new RouteRegister('DELETE', self::normalize($uri), $action);
    }

    protected static function addRoute($method, $uri, $action)
    {
        $uri = self::normalize($uri);
        if (!isset(self::$routes[$method][$uri])) {
            self::$routes[$method][$uri] = $action;
        }
    }

    public static function resource(string $baseUri, string $controller): ResourceRegister
    {
        return (new ResourceRegister($baseUri, $controller));
    }
    
    public static function middleware($middleware)
    {
        static::$middlewareGroup[] = $middleware;
        return new static;
    }

    public function group(\Closure $callback)
    {
        $callback();
        array_pop(static::$middlewareGroup);
    }

    public static function name(string $name, string $method, string $uri)
    {
        foreach (self::$namedRoutes as $existingName => $info) {
            if ($info['method'] === strtoupper($method) && $info['uri'] === self::normalize($uri)) {
                unset(self::$namedRoutes[$existingName]);
                break;
            }
        }
        
        $uri = self::normalize($uri);
        self::$namedRoutes[$name] = [
            'method' => strtoupper($method),
            'uri' => $uri,
        ];
    }

    public static function dispatch($uri, $method)
    {
        $uri = self::normalize(parse_url($uri, PHP_URL_PATH));
        $method = strtoupper($method);

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        foreach (self::$routes[$method] as $route => $action) {
            $pattern = "@^" . preg_replace('@\{[^\}]+\}@', '([^/]+)', $route) . "$@";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                return self::callAction($action, $matches);
            }
        }

        http_response_code(404);
        echo "404 - Página no encontrada";
    }

    protected static function callAction($action, $routeParams = [])
    {
        if (is_array($action)) {
            [$controller, $method] = $action;
            $refMethod = new \ReflectionMethod($controller, $method);
            $params = [];

            foreach ($refMethod->getParameters() as $param) {
                $type = $param->getType();

                if ($type && !$type->isBuiltin()) {
                    $className = $type->getName();
                    $params[] = new $className();
                } else {
                    $params[] = array_shift($routeParams);
                }
            }

            $instance = new $controller;
            return $refMethod->invokeArgs($instance, $params);
        }

        if (is_callable($action)) {
            return call_user_func_array($action, $routeParams);
        }

        throw new \Exception("No se pudo ejecutar la acción.");
    }

    protected static function normalize($uri)
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = str_replace('/index.php', '', $scriptName);
        $uri = str_replace($basePath, '', $uri);
        $uri = rtrim(parse_url($uri, PHP_URL_PATH), '/');
        return $uri === '' ? '/' : $uri;
    }

    public static function getNamedRoutes()
    {
        return self::$namedRoutes;
    }

    public static function getAllRoutes()
    {
        return self::$routes;
    }

    public static function dumpRoutes()
    {
        header('Content-Type: text/html; charset=utf-8');

        echo "<style>
            table { border-collapse: collapse; width: 100%; font-family: sans-serif; }
            th, td { padding: 8px 12px; border: 1px solid #ccc; text-align: left; }
            th { background-color: #f4f4f4; }
        </style>";

        echo "<h1>Lista de rutas registradas</h1>";

        echo "<table>
            <thead>
                <tr>
                    <th>Método</th>
                    <th>URI</th>
                    <th>Acción</th>
                    <th>Nombre (name)</th>
                </tr>
            </thead>
            <tbody>";

        foreach (self::$routes as $method => $routes) {
            foreach ($routes as $uri => $action) {
                // Acción formateada
                if (is_array($action)) {
                    $controller = is_string($action[0]) ? $action[0] : get_class($action[0]);
                    $actionStr = $controller . '@' . $action[1];
                } elseif ($action instanceof \Closure) {
                    $actionStr = 'Closure';
                } else {
                    $actionStr = (string) $action;
                }

                // Buscar si tiene un name
                $routeName = '';
                foreach (self::$namedRoutes as $name => $info) {
                    if ($info['method'] === $method && $info['uri'] === $uri) {
                        $routeName = $name;
                        break;
                    }
                }

                echo "<tr>
                    <td>$method</td>
                    <td>$uri</td>
                    <td>$actionStr</td>
                    <td>$routeName</td>
                </tr>";
            }
        }

        echo "</tbody></table>";
    }
}
