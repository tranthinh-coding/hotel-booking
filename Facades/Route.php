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
        $path = parse_url($uri, PHP_URL_PATH) ?: '';
        return trim($path, '/');
    }

    /**
     * Group routes under a common URI prefix
     */
    public static function group(string $uriPrefix, callable $callback): void
    {
        $prev = self::$prefix;
        // ensure no double slashes
        self::$prefix = self::normalizeUri($prev . '/' . $uriPrefix);
        $callback();
        self::$prefix = $prev;
    }

    public static function get(string $uri, string $controller, string $method): void
    {
        $routeKey = self::normalizeUri(self::$prefix . '/' . $uri);
        self::$routes['GET'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function post(string $uri, string $controller, string $method): void
    {
        $routeKey = self::normalizeUri(self::$prefix . '/' . $uri);
        self::$routes['POST'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function put(string $uri, string $controller, string $method): void
    {
        $routeKey = self::normalizeUri(self::$prefix . '/' . $uri);
        self::$routes['PUT'][$routeKey] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function delete(string $uri, string $controller, string $method): void
    {
        $routeKey = self::normalizeUri(self::$prefix . '/' . $uri);
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
