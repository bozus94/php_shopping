<?php
class PedidoModel
{
    private $id;
    private $usuarioId;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
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

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
        return $this;
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function setCoste($coste)
    {
        $this->coste = $coste;
        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
        return $this;
    }

    public function getOne()
    {
        $sql = $this->db->query(" SELECT * FROM pedidos WHERE id={$this->getId()} ");
        return $sql->fetch_object();
    }

    public function getOneByUser()
    {
        $sql = " SELECT p.id, p.coste, p.usuario_id, p.estado FROM pedidos p";
        $sql .= " WHERE usuario_id={$this->getUsuarioId()} ";
        $sql .= " ORDER BY id DESC LIMIT 1 ";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser()
    {
        $sql = " SELECT p.* FROM pedidos p ";
        $sql .= " WHERE usuario_id={$this->getUsuarioId()} ";
        $sql .= " ORDER BY id DESC ";
        $pedidos = $this->db->query($sql);

        return $pedidos;
    }

    public function getProductosByPedido()
    {

        /* consulta con una subconsulta
        $sql = " SELECT * FROM productos WHERE id IN ( SELECT producto_id FROM lineas_pedido WHERE pedido_id = '{$pedido_id}' ) "; */

        $sql = " SELECT pr.*, lp.unidades FROM productos pr ";
        $sql .= " INNER JOIN lineas_pedido lp ON pr.id = lp.producto_id ";
        $sql .= " WHERE lp.pedido_id = '{$this->getId()}' ";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAll()
    {
        $sql = $this->db->query(" SELECT * FROM pedidos ORDER BY id ");
        return $sql;
    }

    public function save()
    {
        $result['state'] = false;

        $sql = (" INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) VALUES ('{$this->getUsuarioId()}','{$this->getProvincia()}', '{$this->getlocalidad()}', '{$this->getDireccion()}', '{$this->getCoste()}', '{$this->getEstado()}', CURDATE(), CURTIME())");

        $pedido = $this->db->query($sql);

        if ($pedido) {
            $result['state'] = true;
            $result['message'] = 'Tu pedido se creo exisitosamente';
        } else {
            $result['state'] = false;
            $result['message'] = 'No se pudo crear tu pedido';
        }

        return $result;
    }

    public function saveLinea()
    {
        $result = false;

        $sql = $this->db->query(" SELECT LAST_INSERT_ID() as 'pedido' ");
        $pedido_id = $sql->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = " INSERT INTO lineas_pedido (pedido_id, producto_id, unidades) VALUES ('{$pedido_id}', '{$producto->id}', '{$elemento['cantidad']}') ";

            $save = $this->db->query($insert);
        }

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function update()
    {
        $result['state'] = false;

        $sql = " UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql .= " WHERE id='{$this->getId()}' ";
        $update = $this->db->query($sql);

        if ($update) {
            $result['state'] = true;
            $result['message'] = 'Tu pedido se modifico exisitosamente';
        } else {
            $result['state'] = false;
            $result['message'] = 'No se pudo modificar tu pedido';
        }

        return $result;
    }

    public function delete()
    {
        $result['state'] = false;

        $sql = " DELETE FROM pedidos WHERE id='{$this->getId()}' ";
        $delete = $this->db->query($sql);

        if ($delete) {
            $result['state'] = true;
            $result['message'] = 'Pedido eliminado existosamente';
        } else {
            $result['message'] = 'No se pudo eliminar el Pedido';
        }
        return $result;
    }
    public function deleteLinea()
    {
        $result = false;

        $sql = " DELETE FROM lineas_pedido WHERE pedido_id = '{$this->getId()}' ";
        $delete = $this->db->query($sql);

        if ($delete) {
            $result = true;
        }

        return $result;
    }
}
