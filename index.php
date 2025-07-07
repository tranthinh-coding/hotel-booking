<?php

// Load global helper functions
require_once __DIR__ . '/app/Functions/functions.php';

// PSR-4 autoloader for HotelBooking namespace
spl_autoload_register(function ($class) {
    $prefix = 'HotelBooking\\';
    $prefixLen = strlen($prefix);
    if (strncmp($prefix, $class, $prefixLen) !== 0) {
        return;
    }
    $relative = substr($class, $prefixLen);
    $relativePath = str_replace('\\', '/', $relative) . '.php';
    // Try in app/ then root
    $candidates = [
        __DIR__ . '/app/' . $relativePath,
        __DIR__ . '/' . $relativePath,
    ];
    foreach ($candidates as $file) {
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// Determine controller class with namespace
$controllerName = get('controller', 'HomeController');
$controller = 'HotelBooking\\Controllers\\' . $controllerName;
$action = get('action', 'index');

if (class_exists($controller) && method_exists($controller, $action)) {
    $controllerInstance = new $controller();
    $controllerInstance->$action();
} else {
    // Handle error: controller or action not found
    http_response_code(404);
    echo "Controller or action not found.";
}
