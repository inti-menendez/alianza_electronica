<?php

namespace Core;

class Request
{
    protected array $get;
    protected array $post;
    protected array $server;
    protected array $files;

    public function __construct()
    {
        $this->get    = $_GET;
        $this->post   = $_POST;
        $this->server = $_SERVER;
        $this->files  = $_FILES;
    }

    public static function input(string $key, $default = null)
    {
        return self::$post[$key] ?? self::$get[$key] ?? $default;
    }

    public static function all(): array
    {
        return array_merge(self::$get, self::$post, self::$files);
    }

    public static function method(): string
    {
        return strtoupper(self::$server['REQUEST_METHOD'] ?? 'GET');
    }

    public static function file(string $key)
    {
        return self::$files[$key] ?? null;
    }

    public static function isMethod(string $method): bool
    {
        return self::$method() === strtoupper($method);
    }
}