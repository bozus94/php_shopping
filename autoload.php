<?php
function controllers_autoload($controller)
{
    require 'includes/controllers/' . $controller . '.php';
}

spl_autoload_register('controllers_autoload');
