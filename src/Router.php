<?php

namespace Underdash;

class Router {
    private static array $routes = [
        "get" => [],
        "post" => [],
    ];

    /*
     * I personally want to use "login" instead of "/login" so
     * this small function will do the trick for me.
     * */
    public static function preparePurePath(string $path): string
    {
        if(! str_starts_with($path, '/')) {
            $path = "/{$path}";
        }

        return $path;
    }

    public static function get(string $path, \Closure|string $callback): void {
        $path = self::preparePurePath($path);
        self::$routes['get'][$path] = $callback;
    }

    public static function post(string $path, \Closure|string $callback): void {
        $path = self::preparePurePath($path);
        self::$routes['post'][$path] = $callback;
    }

    public static function dispatch(): void {
        $currentRoute = trim($_SERVER['REQUEST_URI'], '/');
        $currentRequestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        $routePatterns = array_keys(self::$routes[$currentRequestMethod]);

        usort($routePatterns, function($firstRoute, $secondRoute) {
            $firstRoutePartCount = count(explode('/', $firstRoute));
            $secondRoutePartCount = count(explode('/', $secondRoute));

            return $secondRoutePartCount - $firstRoutePartCount;
        });

        foreach($routePatterns as $index => $routePattern) {
            $routePattern = trim($routePattern, '/');

            if( count(explode('/', $routePattern)) !== count(explode('/', $currentRoute)) )
                continue;

            $routePattern = preg_replace('/{(.*?)}/', '(.*)', $routePattern);

            if(preg_match("%^{$routePattern}$%", $currentRoute, $matches) == 0)
                continue;

            array_shift($matches);

            $targetCallback = self::$routes[$currentRequestMethod][$routePatterns[$index]];

            if(is_string($targetCallback)) {
                $targetCallback = explode("@", $targetCallback);
            }

            echo call_user_func_array(
                $targetCallback,
                $matches
            );

            break;
        }
    }
}
