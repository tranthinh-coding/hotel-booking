<?php

namespace HotelBooking\Facades;

class Route
{
    protected static array $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'DELETE' => [],
    ];

    public static function get(string $uri, string $controller, string $method): void
    {
        self::$routes['GET'][$uri] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function post(string $uri, string $controller, string $method): void
    {
        self::$routes['POST'][$uri] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function put(string $uri, string $controller, string $method): void
    {
        self::$routes['PUT'][$uri] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function delete(string $uri, string $controller, string $method): void
    {
        self::$routes['DELETE'][$uri] = [
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    public static function resolve(string $uri): ?array
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        return self::$routes[$requestMethod][$uri] 
            ?? null;
    }

    public static function all(): array
    {
        return self::$routes;
    }
}
