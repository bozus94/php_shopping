<?php
include_once 'includes/models/PedidoModel.php';
class PedidoController
{
    public $session;

    public function __construct()
    {
        $this->session = Utils::getController();
    }

    public function index()
    {
        Utils::isAdmin('header');

        $pedido = new PedidoModel();
        $pedidos = $pedido->getAll();

        include_once 'includes/views/pedido/index.view.php';
    }

    public function crear()
    {
        include_once 'includes/views/pedido/crear.view.php';
    }
    public function add()
    {
        if (isset($_SESSION['login'])) {
            $provincia = Utils::sanitizeData($_POST['provincia']);
            $localidad = Utils::sanitizeData($_POST['localidad']);
            $direccion = Utils::sanitizeData($_POST['direccion']);
            $usuarioId = Utils::sanitizeData($_POST['usuarioId']);
            $coste = Utils::sanitizeData($_POST['coste']);
            $estado = Utils::sanitizeData($_POST['estado']);

            if ($provincia && $localidad && $direccion && $usuarioId && $coste && $estado) {

                $pedido = new PedidoModel();
                $pedido->setUsuarioId($usuarioId);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
                $pedido->setEstado($estado);

                $save = $pedido->save();

                if ($save) {
                    /* si se guardo el pedido se guardarn los datos pivotes del pivote */
                    $save_linea = $pedido->saveLinea();
                    if ($save_linea) {
                        $_SESSION[$this->session]['estate'] = $save['state'];
                        $_SESSION[$this->session]['message'] = $save['message'];
                        header('Location:' . RUTA . 'pedido/confirmacion');
                    }
                } else {
                    $_SESSION[$this->session]['estate'] = $save['state'];
                    $_SESSION[$this->session]['message'] = $save['message'];
                    header('Location:' . RUTA . 'carrito/index');
                }
            } else {
                $_SESSION[$this->session]['estate'] = 'failed';
                $_SESSION[$this->session]['estate'] = 'Los datos introducidos no son correctos';
                header('Location:' . RUTA . 'carrito/crear');
            }
        } else {
            header('Location:' . RUTA);
        }
    }

    public function confirmacion()
    {
        if (isset($_SESSION['login']['usuario'])) {
            /* conseguir datos del pedido */
            $usuario = $_SESSION['login']['usuario'];
            $pedido = new PedidoModel();
            $pedido->setUsuarioId($usuario->id);
            $pedido = $pedido->getOneByUser();

            /* conseguir los productos del pedido */
            $prods_pedido = new PedidoModel();
            $prods_pedido->setId($pedido->id);
            $productos = $prods_pedido->getProductosByPedido();

            include_once 'includes/views/pedido/confirmacion.view.php';
        }
    }

    public function pedidos()
    {
        if (Utils::isLogin()) {
            $usuario = $_SESSION['usuario']['usuario'];

            $pedidos = new PedidoModel();
            $pedidos->setUsuarioId($usuario->id);
            $pedidos = $pedidos->getAllByUser();

            include_once 'includes/views/pedido/pedidos.view.php';
        }
    }

    public function pedidoView()
    {
        if (Utils::isLogin()) {
            /* conseguir datos del pedido */
            if (isset($_GET['p'])) {
                $pedido = new PedidoModel();
                $pedido->setId($_GET['p']);
                $pedido = $pedido->getOne();

                if (!$pedido) {
                    header('Location:' . RUTA . 'pedido/pedidos');
                }
                /* conseguir los productos del pedido */
                $prods_pedido = new PedidoModel();
                $prods_pedido->setId($_GET['p']);
                $prods_pedido = $prods_pedido->getProductosByPedido();

                include_once 'includes/views/pedido/ver.view.php';
            } else {
                header('Location:' . RUTA . 'pedido/pedidos');
            }
        }
    }
    public function editar()
    {
        if (Utils::isLogin()) {

            if (isset($_POST['estado']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $estado = Utils::sanitizeData($_POST['estado']);
                $id = Utils::sanitizeData($_POST['id']);

                $editar = true;

                $pedido = new PedidoModel();
                $pedido->setId($id);
                $pedido->setEstado($estado);

                $update = $pedido->update();

                if ($update) {
                    $_SESSION[$this->session]['state'] = $update['state'];;
                    $_SESSION[$this->session]['message'] = $update['message'];
                    header('Location:' . RUTA . 'pedido/pedidoView&p=' . $id);
                }
            }
        }
    }
    public function eliminar()
    {
        if ($_GET['p']) {
            $pedidoID = Utils::sanitizeData($_GET['p']);

            $pedido = new PedidoModel();
            $pedido->setId($pedidoID);

            $delete = $pedido->delete();

            if ($delete) {
                $deleteLinea = $pedido->deleteLinea();
                if ($deleteLinea) {
                    $_SESSION['pedido']['state'] = $delete['state'];
                    $_SESSION['pedido']['message'] = $delete['message'];
                    header('Location:' . RUTA . 'pedido/index');
                } else {
                    $_SESSION['pedido']['state'] = $delete['state'];
                    $_SESSION['pedido']['message'] = $delete['message'];
                    header('Location:' . RUTA . 'pedido/index');
                }
            } else {
                $_SESSION['pedido']['state'] = $delete['state'];
                $_SESSION['pedido']['message'] = $delete['message'];
                header('Location:' . RUTA . 'pedido/index');
            }
        }
    }
}
