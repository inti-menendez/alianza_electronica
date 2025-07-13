<?php

class ResourceRegister
{
    protected string $baseUri;
    protected string $controller;

    protected array $only = [];
    protected array $except = [];
    protected array $names = [];

    public function __construct(string $baseUri, string $controller)
    {
        $this->baseUri = rtrim($baseUri, '/');
        $this->controller = $controller;
    }

    public function only(array $methods): self
    {
        $this->only = $methods;
        return $this;
    }

    public function except(array $methods): self
    {
        $this->except = $methods;
        return $this;
    }

    public function names(array $names)
    {
        $this->names = $names;
        return $this;
    }

    public function register()
    {
        $uriName = ltrim($this->baseUri, '/');
    
        foreach ($this->routes() as $key => $route) {
            if (!empty($this->only) && !in_array($key, $this->only)) {
                continue;
            }
    
            if (in_array($key, $this->except)) {
                continue;
            }
    
            Router::{$this->getHttpMethod($route['method'])}($route['uri'], $route['action']);
    
            $name = $this->names[$key] ?? "$uriName.$key";
            Router::name($name, $route['method'], $route['uri']);
        }
    }

    protected function getHttpMethod(string $method): string
    {
        return strtolower($method);
    }

    public function __destruct()
    {
        $this->register();
    }

    protected function routes(): array
    {
        $uri = $this->baseUri;
        $ctrl = $this->controller;

        return [
            'index' =>   [
                'method' => 'GET',    
                'uri' => $uri,                   
                'action' => [$ctrl, 'index']
            ],
            'data' =>    [
                'method' => 'GET',    
                'uri' => "$uri/data",            
                'action' => [$ctrl, 'data']
            ],
            'store' =>   [
                'method' => 'POST',   
                'uri' => $uri,                   
                'action' => [$ctrl, 'store']
            ],
            'show' =>    [
                'method' => 'GET',    
                'uri' => "$uri/{id}",            
                'action' => [$ctrl, 'show']
            ],
            'update' =>  [
                'method' => 'PUT',    
                'uri' => $uri,
                'action' => [$ctrl, 'update']
            ],
            'destroy' => [
                'method' => 'DELETE', 
                'uri' => $uri,
                'action' => [$ctrl, 'destroy']
            ],
        ];
    }
}