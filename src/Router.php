<?php

class Router {
    private static array $routes = [
        "get" => [],
        "post" => [],
    ];

    public static function preparePurePath(string $path): string
    {
        if(! str_starts_with($path, '/')) {
            $path = "/{$path}";
        }

        return $path;
    }

    public static function get(string $path, Closure|string $callback): void {
        $path = self::preparePurePath($path);
        self::$routes['get'][$path] = $callback;
    }

    public static function post(string $path, Closure|string $callback): void {
        $path = self::preparePurePath($path);
        self::$routes['post'][$path] = $callback;
    }

    public static function dispatch(): void {

    }
}