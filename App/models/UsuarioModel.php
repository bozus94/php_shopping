<?php

class UsuarioModel
{
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = DataBase::conexionDB();
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);
        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $this->db->real_escape_string($password);
        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $this->db->real_escape_string($rol);
        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $this->db->real_escape_string($imagen);
        return $this;
    }

    public function save()
    {
        $result = false;

        $user_exist = Utils::compararCampo($this->db, 'usuarios', 'email', $this->getEmail());
        if ($user_exist->num_rows !== 1) {
            $sql = " INSERT INTO usuarios(nombre, apellidos, email, password, rol) VALUES ('{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getRol()}')";

            $save = $this->db->query($sql);
            Utils::preDump($save);
            if ($save) {
                $result['state'] = true;
            } else {
                $result['state'] = false;
                $result['message'] = 'No se pudo registrar al usuario';
            }
        } else {
            $result['state'] = false;
            $result['message'] = 'Este usuario ya existe';
        }
        return $result;
    }

    public function login()
    {
        $result = false;
        //comprobar si existe el usuario
        $sql = " SELECT * FROM usuarios WHERE email = '{$this->getEmail()}' ";
        $login = $this->db->query($sql);
        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            //verificar la password
            $verify = password_verify($this->getPassword(), $usuario->password);

            if ($verify) {
                $result['usuario'] = $usuario;
                $result['state'] = true;
            } else {
                $result['state'] = false;
                $result['message'] = 'El usuario o la contraseña es incorrecta';
            }
        }
        return $result;
    }
}
