<?php

session_start();
require_once('autoload.php');
require_once('config/App.php');
require_once('config/DataBase.php');
require_once('App/utilities/helpers.php');
require_once('resources/views/partials/header.php');
require_once('resources/views/partials/barra.php');
require_once('resources/views/partials/footer_barra.php');

function error()
{
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $controller = ucfirst($_GET['controller']) . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller = CONTROLLER_DEFAULT;
} else {
    echo 'la clase no existe';
}

if (class_exists($controller)) {
    $controlador = new $controller();
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $accion = $_GET['action'];
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $accion = ACTION_DEFAULT;
        echo $accion;
    }
    $controlador->$accion();
} else {
    echo 'la clase y el metodo no existe';
}

require_once('resources/views/partials/footer.php');
