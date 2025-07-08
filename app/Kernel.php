<?php

namespace HotelBooking;

use Exception;

class Kernel
{
    public function start()
    {
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
            $method     = $route['method'];
            (new $controller())->$method();
        } else {
            throw new Exception("No route found for URI: $uri");
        }
    }

    public function loadHelpers()
    {
        require_once __DIR__ . '/Functions/functions.php';
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
