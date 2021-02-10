<?php

namespace App\Models;

namespace App\Models;

class Categoria
{
    private $id;
    private $nombre;
    private $db;

    public function __construct()
    {
        $this->db = DataBase::conexionDB();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);;
        return $this;
    }

    public function getAll()
    {
        $categorias =  $this->db->query(" SELECT * FROM categorias ORDER BY id DESC ");
        return $categorias;
    }

    public function getOne()
    {
        $categoria =  $this->db->query(" SELECT * FROM categorias WHERE id = '{$this->getId()}' ");
        return $categoria->fetch_object();
    }

    public function save()
    {
        $result['state'] = false;
        $cat_existe = Utils::compararCampo($this->db, 'categorias', 'nombre', $this->getNombre());

        /* comprobamos que la categoria no exista */
        if ($cat_existe->num_rows > 0) {
            $result['state'] = false;
            $result['message'] = 'Esta categoria ya existe!';
        } else {
            $sql = " INSERT INTO categorias (nombre) VALUES ('{$this->getNombre()}')";
            $save =  $this->db->query($sql);
            if ($save) {
                $result['state'] = true;
                $result['message'] = 'Categoria creada existosamente';
            } else {
                $result['state'] = false;
                $result['message'] = 'No se pudo crear la categoria';
            }
        }

        return $result;
    }

    public function delete()
    {
        $result['state'] = false;
        $sql = " DELETE FROM categorias WHERE id = ('{$this->getId()}') ";
        $delete =  $this->db->query($sql);

        if ($delete) {
            $result['state'] = true;
            $result['message'] = 'Categoria eliminada existosamente!';
        } else {
            $result['state'] = false;
            $result['message'] = 'No se pudo eliminar  la categoria!';
        }
        return $result;
    }

    public function update()
    {
        $result['state'] = false;
        $cat_existe = Utils::compararCampo($this->db, 'categorias', 'nombre', $this->getNombre());

        /* comprobamos que la categoria no exista */
        if ($cat_existe->num_rows > 0) {
            $result['state'] = false;
            $result['message'] = 'Esta categoria ya existe!';
        } else {
            $sql = " UPDATE categorias SET nombre='{$this->getNombre()}' WHERE id='{$this->getId()}' ";
            $update =  $this->db->query($sql);

            if ($update) {
                $result['state'] = true;
                $result['message'] = 'Categoria modificada existosamente!';
            } else {

                $result['state'] = false;
                $result['message'] = 'No se pudo modificar la categoria!';
            }
        }

        return $result;
    }
}
