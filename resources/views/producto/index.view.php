<div class="d-flex flex-row">
    <?php
    require('includes/templates/aside.php');
    ?>
    <main>
        <div class="contenedor-main d-flex flex-column ml-5 bg-blanco">
            <div class="section-productos">
                <h2 class="titulo-section-producto">Ofertas de la semana</h2>
                <div class="productos d-flex flex-row flex-wrap">
                    <?php ?>
                    <?php while ($pro = $productos->fetch_object()) : ?>
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
            <div class="section-productos">
                <h2 class="titulo-section-producto">Destacados</h2>
                <div class="productos d-flex flex-row flex-wrap">
                    <?php ?>
                    <?php while ($pro = $productos2->fetch_object()) : ?>
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

        </div><!-- ./contenedor-main -->
    </main>
</div>