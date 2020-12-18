<?php
include_once 'includes/models/ProductoModel.php';

class CarritoController
{
    public function index()
    {/* 
        Utils::preDump($_SESSION['carrito'][0]); */

        $stats = Utils::statsCarrito();
        require_once 'includes/views/carrito/carrito.view.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadirCarrito'])) {

            if (isset($_POST['producto_id'])) {
                $producto_id = $_POST['producto_id'];
            } else {
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
            /* si existe el carrito y counter no es igual 0 y el id es igual se aumentan las unidades */
            if (isset($_SESSION['carrito'])) {
                $counter = 0;
                foreach ($_SESSION['carrito'] as $indice => $elemento) {
                    /*  Utils::preDump($indice);
                    die(); */
                    if ($elemento['id_producto'] == $producto_id) {
                        for ($i = 0; $i < $_POST['cantidad']; $i++) {
                            $_SESSION['carrito'][$indice]['cantidad']++;
                        }
                        $counter++;
                    }
                }
            }
            /* si counter no existe o esta en 0 se añade el producto al carrito*/
            if (!isset($counter) || $counter == 0) {

                /* conseguir producto */
                $product = new ProductoModel();
                $product->setId($producto_id);
                $producto = $product->getOne();

                /* añadir la carrito */
                if (is_object($producto)) {
                    $_SESSION['carrito'][] = array(
                        'id_producto' => $producto->id,
                        'precio' => $producto->precio,
                        'cantidad' => isset($_POST['cantidad']) ? $_POST['cantidad'] : 1,
                        'producto' => $producto
                    );
                }
                /* Utils::preDump($_SESSION['carrito']); */
            }
            header('Location:' . RUTA . 'carrito/index');
        } else {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    
    public function delete()
    {
        unset($_SESSION['carrito']);
        header('location:' . RUTA);
    }

    public function remove()
    {
        if (isset($_GET['prod'])) {
            $indice = $_GET['prod'];
            if (isset($_SESSION['carrito'][$indice])) {
                $indice = $_SESSION['carrito'][$indice];
                foreach (array_keys($_SESSION['carrito'], $indice) as $key) {
                    unset($_SESSION['carrito'][$key]);
                    header('Location:' . RUTA . 'carrito/index');
                }
            }
        }
    }
}
