<?php

// PSR-4 Autoloader
spl_autoload_register(function(string $class) {
    $prefix = 'HotelBooking\\';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relative = str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    $baseDir  = __DIR__;

    // try in Facades/, app/
    $candidates = [
        "$baseDir/Facades/$relative",
        "$baseDir/app/$relative",
        "$baseDir/$relative",
    ];

    foreach ($candidates as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

use HotelBooking\Kernel;

$kernel = new Kernel();

$kernel->start();
