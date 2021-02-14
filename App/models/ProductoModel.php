<?php
class ProductoModel
{
    private $id;
    private $categoriaId;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
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

    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $this->db->real_escape_string($categoriaId);
        return $this;
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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
        return $this;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $this->db->real_escape_string($fecha);
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

    public function getOne()
    {
        $sql = $this->db->query(" SELECT * FROM productos WHERE id={$this->getId()} ");
        return $sql->fetch_object();
    }

    public function getRamdom($limit_productos)
    {
        $productos = $this->db->query(" SELECT * FROM productos ORDER BY RAND() LIMIT $limit_productos ");

        return $productos;
    }

    public function getAll()
    {
        $sql = $this->db->query(" SELECT * FROM productos ORDER BY id ");
        return $sql;
    }

    public function getAllCategoria()
    {
        $sql = " SELECT p.*, c.nombre AS catnombre FROM productos p "
            . " INNER JOIN categorias c ON c.id = p.categoria_id "
            . " WHERE p.categoria_id = '{$this->getCategoriaId()}' "
            . " ORDER BY id DESC ";

        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save()
    {
        $result = false;

        $sql = (" INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, fecha, imagen) 
        VALUES ('{$this->getCategoriaId()}','{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getPrecio()}', '{$this->getStock()}', CURDATE(), '{$this->getImagen()}') ");

        $save = $this->db->query($sql);

        if ($save) {
            $result = true;
        }

        return $save;
    }

    public function delete()
    {
        $result = false;
        $sql = " DELETE FROM productos WHERE id={$this->getId()} ";
        $delete = $this->db->query($sql);

        if ($delete) {
            $result = true;
        }

        return $result;
    }

    public function update()
    {
        $result = false;

        $sql = " UPDATE productos SET categoria_id='{$this->getCategoriaId()}', nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio='{$this->getPrecio()}', stock='{$this->getStock()}' ";

        if ($this->getImagen() != null) {
            $sql .= " , imagen='{$this->getImagen()}'  ";
        }

        $sql .= " WHERE id='{$this->getId()}' ";

        $update = $this->db->query($sql);

        if ($update) {
            $result = true;
        }

        return $update;
    }
}
