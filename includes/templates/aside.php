<?php $usuario_session = isset($_SESSION['usuario']['usuario']) ? $_SESSION['usuario']['usuario'] : null ?>

<aside class="panel">
    <?php if (Utils::isLogin()) : ?>
        <div class="section_panel ">
            <h3 class="titulo_section_panel"><?= $usuario_session->nombre ?></h3>
            <div class="contenedor_section_panel">
                <a href="<?= RUTA ?>pedido/pedidos" class="btn-aside">Mis pedidos</a>
            </div>
        </div>
    <?php endif ?>
    <?php if (Utils::isAdmin()) : ?>
        <div class="section_panel ">
            <h3 class="titulo_section_panel">@Admin</h3>
            <div class="contenedor_section_panel">
                <a href="<?= RUTA; ?>categoria/index" class="btn-aside ">Gestionar categorias</a>
                <a href="<?= RUTA; ?>producto/gestion" class="btn-aside ">Gestionar Productos</a>
                <a href="<?= RUTA; ?>pedido/index" class="btn-aside ">Gestionar Pedidos</a>
            </div>
        </div>
    <?php endif ?>



    <div class="section_panel ">
        <h3 class="titulo_section_panel">Categorias</h3>
        <div class="contenedor_section_panel">
            <?php $categorias = Utils::showCategorias(); ?>
            <ul class="d-flex flex-column">
                <?php while ($categoria = $categorias->fetch_object()) : ?>
                    <a href="<?= RUTA ?>categoria/categoria&cat=<?= $categoria->id ?>" class="link_btn_aside">
                        <li class="btn-aside"><?= $categoria->nombre; ?></li>
                    </a>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</aside>