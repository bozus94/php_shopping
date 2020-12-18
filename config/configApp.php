<?php

define('RUTA', 'http://php_shopping.test/');
define('CONTROLLER_DEFAULT', 'ProductoController');
define('ACTION_DEFAULT', 'index');
define('PRODUCTOS_X_SECTION', 5);

$bd_config = array(
    'db_nombre' => 'tienda_master',
    'usuario' => 'root',
    'password' => '',
    'puerto' => 3306
);

$nombre_pagina = htmlspecialchars($_SERVER['PHP_SELF']);
