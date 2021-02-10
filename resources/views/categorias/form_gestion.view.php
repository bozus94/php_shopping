<?php

if (isset($editar) && isset($cat) && is_object($cat)) {
    $accion = 'editar';
    $titulo = 'Editar <strong>' . $cat->nombre . '</strong>';
    $url = RUTA . 'categoria/guardar&cat=' . $cat->id;
} else {
    $accion = 'crear';
    $titulo = 'Crear categoria';
    $url = RUTA . 'categoria/guardar';
}

?>

<main class="main-100 vh77-center d-flex flex-column">
    <h2><?= $titulo ?> </h2>
    <div class="contenedor-main d-flex flex-column flex-y-center h-100 formulario bg-blanco">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto">
                <a href="<?= RUTA ?>categoria/index" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
            </div>
            <?php if (isset($_SESSION[$this->session])) : ?>
                <?php if ($_SESSION[$this->session]['state'] === true) : ?>
                    <h3 class="alert alert-success alert-animate"><?= $_SESSION[$this->session]['message'] ?></h3>
                <?php else : ?>
                    <h3 class="alert alert-error alert-animate"><?= $_SESSION[$this->session]['message'] ?></h3>
                <?php endif; ?>
            <?php endif;
            Utils::deleteSession($this->session);
            ?>
        </div><!-- ./contenedor-main-header -->
        <div class="formulario-2 w-100 box-shadow">
            <form action="<?= $url ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="<?= isset($cat) ? $cat->nombre : '' ?>">
                <div class="footer-form">
                    <div class="btn-group d-flex flex-column ">
                        <input type="submit" value="<?= ucfirst($accion); ?>" class="btn btn-submit btn-hover w-50-center" name="categoria">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>