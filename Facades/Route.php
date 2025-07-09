<?php

namespace HotelBooking\Facades;

class Route
{
    // current group prefix
    protected static string $prefix = '';

    protected static array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
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

        // For routes with parameters, keep the pattern as-is
        // Only normalize routes without parameters
        if (strpos($path, '{') === false) {
            return $path === '/' ? '/' : rtrim($path, '/');
        }

        return $path;
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
            'method' => $method,
        ];
    }

    public static function post(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['POST'][$routeKey] = [
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public static function put(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['PUT'][$routeKey] = [
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public static function delete(string $uri, string $controller, string $method): void
    {
        $routeKey = self::buildRouteKey(self::$prefix, $uri);
        self::$routes['DELETE'][$routeKey] = [
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public static function resolve(string $uri): ?array
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $normalizedUri = self::normalizeUri($uri);

        // First try exact match
        if (isset(self::$routes[$requestMethod][$normalizedUri])) {
            return self::$routes[$requestMethod][$normalizedUri];
        }

        // Try pattern matching for routes with parameters
        foreach (self::$routes[$requestMethod] as $pattern => $route) {
            $params = self::matchRoute($pattern, $normalizedUri);
            if ($params !== false) {
                return array_merge($route, ['params' => $params]);
            }
        }

        return null;
    }

    /**
     * Match a route pattern against a URI and extract parameters
     */
    private static function matchRoute(string $pattern, string $uri): array|false
    {
        // Convert route pattern to regex
        // Replace {param} with named capture groups
        $regex = preg_replace('/\{([^}]+)\}/', '(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . $regex . '$#';

        if (preg_match($regex, $uri, $matches)) {
            // Extract only named parameters
            $params = [];
            foreach ($matches as $key => $value) {
                if (!is_numeric($key)) {
                    $params[$key] = $value;
                }
            }
            return $params;
        }

        return false;
    }

    public static function all(): array
    {
        return self::$routes;
    }
}
