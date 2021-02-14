<?php
die($_SERVER['REQUEST_URI']);
session_start();

require_once('autoload.php');
require_once('config/configApp.php');
require_once('config/DataBase.php');
require_once('includes/funciones/funciones.php');
require_once('includes/templates/header.php');
require_once('includes/templates/barra.php');
require_once('includes/templates/footer_barra.php');

$controller = null;
$action = null;

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
    error();
    exit();
}

if (class_exists($controller)) {
    $controlador = new $controller();
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $accion = $_GET['action'];
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $accion = ACTION_DEFAULT;
    } else {
        error();
    }
    $controlador->$accion();
} else {
    error();
}

require_once('includes/templates/footer.php');
