<?php

class RouteRegister {
    protected string $method;
    protected string $uri;
    protected mixed $action;

    public function __construct(string $method, string $uri, mixed $action)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->action = $action;
    }

    public function name(string $routeName): static
    { 
        Router::name($routeName, $this->method, $this->uri);
        return $this;
    }
}