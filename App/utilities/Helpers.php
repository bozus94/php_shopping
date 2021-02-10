<?php

namespace App\Utilities;

class Helpers
{
    public static function preDump($objeto)
    {
        echo '<pre>';
        var_dump($objeto);
        echo '</pre>';
    }

    public static function deleteSession($session)
    {
        if (isset($_SESSION[$session])) {
            unset($_SESSION[$session]);
        }
    }

    public static function sanitizeData($data)
    {
        $result = false;

        if (!empty($data)) {
            if (is_integer($data)) {
                $sanitize = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
            } else {
                $sanitize = filter_var($data, FILTER_SANITIZE_STRING);
            }
            $result = $sanitize;
        }

        return $result;
    }

    public static function sanitizeEmail($email)
    {
        $result = false;
        if (!empty($email)) {
            $sanitize = filter_var($email, FILTER_SANITIZE_STRING);
            $result = $sanitize;
        }

        return $result;
    }

    public static function passwordHash($password, $cost)
    {
        $result = false;
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
            $result = $hash;
        }

        return $result;
    }

    public static function isAdmin($accion = null)
    {
        $isAdmin = false;

        if (isset($_SESSION['usuario']['admin'])) {
            $isAdmin = true;
        } elseif (isset($_SESSION['usuario']['admin'])) {
            if ($accion === 'header') {
                header('Location:' . RUTA);
            } elseif ($accion == 'login') {
                header('Location:' . RUTA . 'usuario/iniciarSesion');
            }
        }
        return $isAdmin;
    }

    public static function isLogin($accion = null)
    {
        $isLogin = false;

        if (isset($_SESSION['usuario']['usuario'])) {
            $isLogin = true;
        } else {
            if ($accion === 'header') {
                header('Location:' . RUTA);
            } elseif ($accion == 'login') {
                header('Location:' . RUTA . 'usuario/iniciarSesion');
            }
        }
        return $isLogin;
    }

    public static function compararCampo($db, $tabla, $campo, $datoComparar)
    {
        $sql = $db->query(" SELECT * FROM $tabla WHERE $campo = '{$datoComparar}' ");
        return $sql;
    }

    public static function showCategorias()
    {
        include_once 'includes/models/CategoriaModel.php';
        $categoria = new CategoriaModel();
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $indice => $producto) {
                $stats['count'] += $producto['cantidad'];
                $stats['total'] += $producto['precio'] * $producto['cantidad'];
            }
        }
        return $stats;
    }

    public static function getController()
    {
        $result = false;
        if (isset($_GET['controller'])) {
            $result = $_GET['controller'];
        }
        return $result;
    }

    public static function comprobarSwl($database)
    {
        if (isset($database->error)) {
            echo $database->error;
            echo '<br>';
            echo $database->errno;
            echo '<br>';
            foreach ($database->error_list as $error) {
                echo $error;
            }
            die();
        }
    }

    public static function view($view, $variables)
    {
        if (file_exists(RUTA . '/resources/views/' . $vie . '.view.php')) {
            if ($variables) {
                extract($variables);
            }
            return include_once RUTA . '/resources/views/' . $view . '.view.php';
        } else {
            echo RUTA . '/resources/views/' . $view . '.view.php';
            return die('No existe la vista proporcionada');
        }
    }
}
