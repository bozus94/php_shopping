<?php

$categorias = Utils::showCategorias();

if (isset($editar) && isset($pro) && is_object($pro)) {
    $url_action =  RUTA . 'producto/guardar&id=' . $pro->id;
    $titulo = 'Editar producto <strong>' . $pro->nombre . '</strong>';
    $submit_value = 'Editar';
} else {
    $url_action =  RUTA . 'producto/guardar';
    $titulo = 'Crear producto ';
    $submit_value = 'Crear';
}

?>

<main class="main-100 vh77-center d-flex flex-column">
    <h2> <?= $titulo ?></h2>
    <div class="contenedor-main d-flex flex-column flex-y-center h-100  bg-blanco formulario">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto mr-5">
                <a href="<?= RUTA ?>producto/gestion" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
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
            <form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" <?= (isset($pro) && is_object($pro)) ? "value='{$pro->nombre}'" : '' ?>>
                <textarea name="descripcion" class="form-control textarea" placeholder="Descripcion"><?= (isset($pro) && is_object($pro)) ? $pro->descripcion : '' ?></textarea>
                <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio" <?= (isset($pro) && is_object($pro)) ? "value='{$pro->precio}'" : '' ?>>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Stock" <?= (isset($pro) && is_object($pro)) ? "value='{$pro->stock}'" : '' ?>>
                <select name="categoriaId" id="categoriaId" class="form-control">
                    <option value="null">Seleccione una categoria </option>
                    <?php while ($cat = $categorias->fetch_object()) : ?>
                        <option value="<?= $cat->id; ?>" <?= (isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id) ? "selected" : '' ?>><?= $cat->nombre; ?> </option>
                    <?php endwhile; ?>
                </select>
                <input type="file" name="image" id="image" class="form-control">
                <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)) : ?>
                    <div class="thumbs_container w-100 d-flex">
                        <img src="<?= RUTA ?>uploads/images/<?= $pro->imagen ?>" alt="<?= $pro->imagen ?>" class="thumb_form">
                    </div>
                <?php endif; ?>
                <div class="footer-form">
                    <div class="btn-group d-flex flex-column ">
                        <input type="submit" value="<?= $submit_value ?>" class="btn btn-submit btn-hover w-50-center" name="submit">
                    </div>
                </div><!-- ./footer-form -->
            </form><!-- ./form -->
        </div><!-- ./formulario -->
    </div><!-- ./contenedor_main -->
</main>