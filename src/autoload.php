<?php

spl_autoload_register(function ($className) {
    $searchPattern = 'ProsusPay';
    // Abort here if we do not try to load ProsusPay namespace.
    if (strpos($className, $searchPattern) !== 0) {
        return;
    }

    // Convert namespace and class to file path.
    $filePath =  __DIR__ . str_replace([$searchPattern, '\\'], ['', DIRECTORY_SEPARATOR], $className).'.php';
    if (file_exists($filePath)) {
        require_once($filePath);
        return;
    }
});
