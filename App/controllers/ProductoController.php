<?php
include_once 'includes/models/ProductoModel.php';

class ProductoController
{
    public $session;

    public function __construct()
    {
        $this->session = Utils::getController();
    }

    public function index()
    {
        $producto = new ProductoModel();
        $productos = $producto->getRamdom(PRODUCTOS_X_SECTION);
        $productos2 = $producto->getRamdom(PRODUCTOS_X_SECTION);
        require_once 'includes/views/producto/index.view.php';
    }

    public function productoView()
    {
        if (isset($_GET['id'])) {
            $idProd = $_GET['id'];
            $prod = new ProductoModel();
            $prod->setId($idProd);
            $producto = $prod->getOne();
            require_once 'includes/views/producto/producto.view.php';
        } else {
            header('Location:' . RUTA);
        }
    }

    public function gestion()
    {
        Utils::isAdmin('header');
        $producto = new ProductoModel();
        $productos = $producto->getAll();
        require_once 'includes/views/producto/gestion.view.php';
    }

    public function crear()
    {
        Utils::isAdmin('header');
        require_once 'includes/views/producto/form_gestion.view.php';
    }

    public function guardar()
    {
        Utils::isAdmin('header');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

            $nombre =  Utils::sanitizeData($_POST['nombre']);
            $categoriaId =  Utils::sanitizeData($_POST['categoriaId']);
            $descripcion = Utils::sanitizeData($_POST['descripcion']);
            $precio =  Utils::sanitizeData($_POST['precio']);
            $stock = Utils::sanitizeData($_POST['stock']);
            $file = ($_FILES['image']);
            $name_file = Utils::sanitizeData($file['name']);


            if ($nombre && $categoriaId && $descripcion && $precio && $stock) {
                $producto = new ProductoModel();

                $producto->setCategoriaId($categoriaId);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);

                /* comprobamos que nos llegue la imagen para procesarla */
                if (isset($name_file) && $name_file !== '') {
                    $mimetype = $file['type'];
                    $file_tmp_name = $file['tmp_name'];
                    $file_destination = 'uploads/images';

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg') {
                        if (!is_dir($file_destination)) {
                            mkdir($file_destination, 0777, true);
                        }
                        $producto->setImagen($name_file);
                    }
                }

                /* comprobamos que nos llegue por le metodo get el parametro id */
                /* si nos llega el parametro actulizamos el producto */
                /* de lo contrario se trata de un nuevo porducto */
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->update();
                } else {
                    $save = $producto->save();
                }

                /* verificamos que la sentencia sql se haya relizado correctamente */
                if ($save) {
                    move_uploaded_file($file_tmp_name, $file_destination . '/' . $name_file);
                    $_SESSION['producto']['state'] = true;
                    $accion_mensaje = $_POST['submit'] == 'Crear' ? 'Agrego' : ' Modifico';
                    $_SESSION['producto']['message'] = "<span class='alert_span'> {$nombre} </span> se " . $accion_mensaje . " correctamente";
                    header('Location:' . RUTA . 'producto/gestion');
                } else {
                    $_SESSION['producto']['state'] = 'error';
                    $_SESSION['producto']['message'] = 'No se pudo agregar el producto';
                    header('Location:' . RUTA . 'producto/gestion');
                }
            } else {
                $_SESSION['producto']['state'] = 'error';
                $_SESSION['producto']['message'] = 'Todos los datos son obligatorios';

                header('Location:' . RUTA . 'producto/crear');
            }
        }
    }

    public function eliminar()
    {
        Utils::isAdmin('header');
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {

            $id = Utils::sanitizeData($_GET['id']);

            if ($id) {
                $producto = new ProductoModel();
                $producto->setId($id);

                $delete = $producto->delete();

                if ($delete) {
                    $_SESSION['producto']['state'] = true;
                    $_SESSION['producto']['message'] = 'Se elimino el producto correctamente';

                    header('Location:' . RUTA . 'producto/gestion');
                } else {
                    $_SESSION['producto']['state'] = 'error';
                    $_SESSION['producto']['message'] = 'No se pudo borrar el producto';

                    header('Location:' . RUTA . 'producto/gestion');
                }
            } else {
                $_SESSION['producto']['state'] = 'error';
                $_SESSION['producto']['message'] = 'Se intento eliminar un producto no valido';

                header('Location:' . RUTA . 'producto/gestion');
            }
        } else {
            $_SESSION['producto']['state'] = 'error';
            $_SESSION['producto']['message'] = 'Error al borrar el producto';

            header('Location:' . RUTA . 'producto/gestion');
        }
    }

    public function editar()
    {
        Utils::isAdmin('header');
        if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'GET') {

            $editar = true;

            $producto = new ProductoModel();
            $producto->setId($_GET['id']);
            $pro = $producto->getOne();

            require_once 'includes/views/producto/form_gestion.view.php';
        }
    }
}
