<?php
function controllers_autoload($controller)
{
    define("PROJECTPATH", dirname(__DIR__));
    define('BASE_PATH', realpath(dirname(__FILE__)));
    $filename = __DIR__ .  '\\App\\controllers\\' . $controller . '.php';
    $filename_real = str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $filename);
    echo $filename_real;
    require $filename_real;

    // Check to see whether the include declared the class
    if (!class_exists($controller, false)) {
        trigger_error("Unable to load controller: $controller", E_USER_WARNING);
    }
}

spl_autoload_register('controllers_autoload');
