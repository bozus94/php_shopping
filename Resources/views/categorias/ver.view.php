<div class="d-flex flex-row">
    <?php
    require('includes/templates/aside.php');
    ?>
    <main class="ml-5">
        <h2><?= isset($category) ?  'Categoria: ' . $category->nombre : ' La categoria no existe' ?></h2>
        <div class="contenedor-main d-flex flex-column flex-center bg-blanco">
            <?php if ($products->num_rows > 0) : ?>
                <div class="section-productos">
                    <div class="productos d-flex flex-row flex-wrap">
                        <?php while ($pro = $products->fetch_object()) : ?>
                            <div class="producto">
                                <a href="<?= RUTA; ?>producto/productoView&prod=<?= $pro->id; ?>" class="link-producto">
                                    <div class="thumb-producto">
                                        <?php if ($pro->imagen == null) : ?>
                                            <img src="<?= RUTA; ?>assets/img/new-product2.jpg" alt="producto">
                                        <?php else : ?>
                                            <img src="<?= RUTA; ?>uploads/images/<?= $pro->imagen; ?>" alt="producto">
                                        <?php endif; ?>
                                    </div><!-- ./thumb-producto -->
                                    <div class="info-producto">
                                        <p class="precio-producto">$<?= $pro->precio; ?></p>
                                        <p class="titulo-producto"><?= $pro->nombre; ?></p>
                                    </div><!-- ./info-producto -->
                                </a>
                            </div>
                            <!--./producto -->
                        <?php endwhile; ?>
                    </div>
                    <!--./productos -->
                </div><!-- ./section-producto -->
            <?php else : ?>
                <p class="p-5">No hay productos para mostrar</p>
            <?php endif; ?>

        </div><!-- ./contenedor-main -->
    </main>
</div>