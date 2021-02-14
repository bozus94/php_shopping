<?php
include_once 'includes/models/CategoriaModel.php';
include_once 'includes/models/ProductoModel.php';

class CategoriaController
{

    public $session;

    public function __construct()
    {
        $this->session = Utils::getController();/* 
        Utils::preDump($_GET); */
    }

    public function index()
    {
        Utils::isAdmin('header');

        $categoria = new CategoriaModel();
        $categorias = $categoria->getAll();

        require_once 'includes/views/categorias/index.view.php';
    }

    public function categoria()
    {
        if (isset($_GET['cat'])) {
            $catId = Utils::sanitizeData($_GET['cat']);

            /* conseguir la categoria */
            $category = new CategoriaModel();
            $category->setId($catId);
            $category = $category->getOne();

            /* conseguir los productos */
            $product = new ProductoModel();
            $product->setCategoriaId($catId);
            $products = $product->getAllCategoria();
        }

        require_once 'includes/views/categorias/ver.view.php';
    }

    public function crear()
    {
        if (Utils::isAdmin('header')) {
            require_once 'includes/views/categorias/form_gestion.view.php';
        }
    }

    public function editar()
    {
        if (Utils::isAdmin('header')) {
            if (isset($_GET['cat'])) {
                $editar = true;
                $catId = Utils::sanitizeData($_GET['cat']);

                $cat = new CategoriaModel();
                $cat->setId($catId);
                $cat = $cat->getOne();

                require_once 'includes/views/categorias/form_gestion.view.php';
            } else {
                header('Location:' . RUTA . 'categoria/index');
            }
        }
    }

    public function guardar()
    {
        Utils::isAdmin('header');
        if (isset($_POST) && isset($_POST['nombre'])) {

            $nombre = ($_POST['nombre'] != '') ? Utils::sanitizeData(ucfirst($_POST['nombre'])) : null;

            if ($nombre) {
                $categoria = new CategoriaModel();
                $categoria->setNombre($nombre);

                if (isset($_GET['cat'])) {
                    $catId = Utils::sanitizeData($_GET['cat']);
                    $url = 'editar&cat=' . $catId;

                    $categoria->setId($catId);
                    $categoria = $categoria->update();
                } else {
                    $url = 'crear';
                    $categoria = $categoria->save();
                }

                if ($categoria) {
                    $_SESSION[$this->session]['state'] = $categoria['state'];
                    $_SESSION[$this->session]['message'] = $categoria['message'];
                    if ($_SESSION[$this->session]['state'] !== true) {
                        header('Location:' . RUTA . 'categoria/' . $url);
                    } else {
                        header('Location:' . RUTA . 'categoria/index');
                    }
                }
            }
        }
    }

    public function eliminar()
    {
        Utils::isAdmin('header');
        if (isset($_GET['cat'])) {
            $catId = Utils::sanitizeData($_GET['cat']);

            /* conseguir la categoria */
            $category = new CategoriaModel();
            $category->setId($catId);
            $delete = $category->delete();

            if ($delete) {
                $_SESSION[$this->session]['state'] = $delete['state'];
                $_SESSION[$this->session]['message'] = $delete['message'];
                header('Location:' . RUTA . 'categoria/index');
            }
        } else {
            $_SESSION[$this->session]['state'] = $delete['state'];
            $_SESSION[$this->session]['message'] = $delete['message'];
            header('Location:' . RUTA . 'categoria/index');
        }
    }
}
