<?php

namespace App\Controllers;

class UsuarioController
{
    public $session;

    public function __construct()
    {
        $this->session = Utils::getController();
    }

    public function index()
    {
        echo 'controlador usuario,Accion index';
    }

    public function registro()
    {
        require_once 'includes/views/usuario/registro.view.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['registro']) && $_POST['registro'] === 'Registrarse') {
                $nombre = isset($_POST['nombre']) ? Utils::sanitizeData($_POST['nombre']) : false;
                $apellidos = isset($_POST['apellidos']) ? Utils::sanitizeData($_POST['apellidos']) : false;
                $password = isset($_POST['password']) ? Utils::sanitizeData($_POST['password']) : false;
                $password_hash = Utils::passwordHash($password, 12);
                $rol = isset($_POST['rol']) ? Utils::sanitizeData($_POST['rol']) : false;
                $imagen = isset($_POST['imagen']) ? Utils::sanitizeData($_POST['imagen']) : false;
                $email = isset($_POST['email']) ? Utils::sanitizeEmail($_POST['email']) : false;

                if ($nombre && $apellidos && $password && $rol && $email) {

                    $usuario = new UsuarioModel();

                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setPassword($password_hash);
                    $usuario->setEmail($email);
                    $usuario->setRol($rol);

                    $save = $usuario->save();

                    if ($save['state'] === true) {
                        $_SESSION[$this->session]['state'] = $save['state'];
                        $_SESSION[$this->session]['newReg'] = 'Inicia Sesion con tu usuario y contraseña';
                        header('Location:' . RUTA . 'usuario/iniciarSesion');
                    } else {
                        $_SESSION[$this->session]['state'] = $save['state'];
                        $_SESSION[$this->session]['message'] = $save['message'];
                        header('Location:' . RUTA . 'usuario/registro');
                    }
                } else {
                    $_SESSION[$this->session]['state'] = false;
                    $_SESSION[$this->session]['message'] = 'Todos los campos son obligatorios';
                    header('Location:' . RUTA . 'usuario/registro');
                }
            } else {
                $_SESSION[$this->session]['state'] = false;
                $_SESSION[$this->session]['message'] = 'No se pudo registrar al usuario';
                header('Location:' . RUTA . 'usuario/registro');
            }
        } else {
            $_SESSION[$this->session]['state'] = false;
            $_SESSION[$this->session]['message'] = 'No se pudo registrar al usuario';
            header('Location:' . RUTA . 'usuario/registro');
        }
    }

    public function iniciarSesion()
    {
        if (isset($_SESSION[$this->session]['status']) && $_SESSION[$this->session]['status'] === true) {
            header('Location:' . RUTA);
        } else {
            require_once 'includes/views/usuario/login.view.php';
        }
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

            $email = isset($_POST['usuario']) ? Utils::sanitizeEmail($_POST['usuario']) : false;
            $password = isset($_POST['password']) ? Utils::sanitizeData($_POST['password']) : false;

            if ($email && $password) {
                $usuario = new UsuarioModel();

                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $login = $usuario->login();

                if ($login && is_object($login['usuario'])) {
                    $_SESSION[$this->session]['usuario'] = $login['usuario'];
                    if ($login['usuario']->rol === 'admin') {
                        $_SESSION[$this->session]['admin'] = true;
                    }
                    header('Location:' . RUTA);
                } else {
                    $_SESSION[$this->session]['state'] = $login['state'];
                    $_SESSION[$this->session]['message'] = $login['message'];
                    header('Location:' . RUTA . 'usuario/iniciarSesion');
                }
            } else {
                $_SESSION['login']['state'] = false;
                $_SESSION['login']['message'] = 'No se pudo iniciar sesesion';
                header('Location:' . RUTA . 'usuario/iniciarSesion');
            }
        } else {
            $_SESSION['login']['state'] = false;
            $_SESSION['login']['message'] = 'No se pudo iniciar sesion';
            header('Location:' . RUTA . 'usuario/iniciarSesion');
        }
    }

    public function logOut()
    {
        Utils::deleteSession('usuario');

        if (isset($_SESSION['usuario']['admin'])) {
            Utils::deleteSession('admin');
        }

        header('Location:' . RUTA);
    }
}
