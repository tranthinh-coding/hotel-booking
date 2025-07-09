<?php

namespace HotelBooking;

use Exception;

class Kernel
{
    public function start()
    {
        $this->loadEnvironment();
        $this->startSession();
        $this->loadHelpers();
        $this->loadRoutes();

        try {
            $this->startPage();
        } catch (Exception $e) {
            // Handle exceptions and display error pages
            echo "Error: " . $e->getMessage();
        }
    }

    public function startPage()
    {
        // Start the page rendering process
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $route = \HotelBooking\Facades\Route::resolve($uri);
        if ($route) {
            $controller = $route['controller'];
            $method = $route['method'];
            $params = $route['params'] ?? [];

            $controllerInstance = new $controller();

            // If there are parameters, pass them to the method
            if (!empty($params)) {
                // Pass parameters as individual arguments
                $reflection = new \ReflectionMethod($controllerInstance, $method);
                $methodParams = $reflection->getParameters();

                $args = [];
                foreach ($methodParams as $param) {
                    $paramName = $param->getName();
                    if (isset($params[$paramName])) {
                        $args[] = $params[$paramName];
                    } elseif ($param->isDefaultValueAvailable()) {
                        $args[] = $param->getDefaultValue();
                    } else {
                        $args[] = null;
                    }
                }

                call_user_func_array([$controllerInstance, $method], $args);
            } else {
                $controllerInstance->$method();
            }
        } else {
            throw new Exception("No route found for URI: $uri");
        }
    }

    public function loadHelpers()
    {
        require_once __DIR__ . '/Functions/functions.php';
    }

    public function loadEnvironment()
    {
        $envFile = __DIR__ . '/../.env';

        if (!file_exists($envFile)) {
            return;
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Parse key=value pairs
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Remove quotes if present
                if (
                    (substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                    (substr($value, 0, 1) === "'" && substr($value, -1) === "'")
                ) {
                    $value = substr($value, 1, -1);
                }

                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }

    public function loadRoutes()
    {
        require_once __DIR__ . '/../router.php';
    }

    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
