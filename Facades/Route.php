<?php

namespace HotelBooking\Facades;

class Route
{
    // current group prefix
    protected static string $prefix = '';

    protected static array $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'DELETE' => [],
    ];

    private static function normalizeUri(string $uri): string
    {
        // Parse URL to get path only (remove query string)
        $path = parse_url($uri, PHP_URL_PATH) ?: '';
        
        // Ensure leading slash, remove trailing slash (except for root)
        $path = '/' . ltrim($path, '/');
        return $path === '/' ? '/' : rtrim($path, '/');
    }

    private static function buildRouteKey(string $prefix, string $uri): string
    {
        // Normalize both prefix and uri
        $prefix = trim($prefix, '/');
        $uri = trim($uri, '/');
        
        // Build final path
        if (empty($prefix)) {
            $path = '/' . $uri;
        } else {
            $path = '/' . $prefix . '/' . $uri;
        }
        
        // Normalize final result
        return $path === '/' ? '/' : rtrim($path, '/');
    }

    /**
     * Group routes under a common URI prefix
     */
    public static function group(string $uriPrefix, callable $callback): void
    {
        $prev = self::$prefix;
        self::$prefix = trim($uriPrefix, '/');
        $callback();
        self::$prefix = $prev;
    }

    public static function get(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['GET'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function post(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['POST'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function put(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['PUT'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function delete(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['DELETE'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function resolve(string $uri): ?array
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $key = self::normalizeUri($uri);
        return self::$routes[$requestMethod][$key] ?? null;
    }

    public static function all(): array
    {
        return self::$routes;
    }
}
