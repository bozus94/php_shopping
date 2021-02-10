<main class="main-100 vh77-center d-flex">
    <?php if ($producto) : ?>

        <div class="contenedor-main d-flex flex-column h-100 bg-blanco">
            <div class="contenedor-main-header d-flex w-100 flex-y-center">
                <div class="bg-blanco mr-auto mr-5">
                    <a href="<?= RUTA ?>" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
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
            <div class="producto-detalles d-flex flex-column">
                <div class="d-flex flex-row flex-y-center">
                    <div class="thumb-detalle-producto">
                        <?php if ($producto->imagen == null) :  ?>
                            <img src="<?= RUTA; ?>/assets/img/new-product2.jpg" alt="">
                        <?php else :  ?>
                            <img src="<?= RUTA; ?>uploads/images/<?= $producto->imagen ?>" alt="">
                        <?php endif;  ?>
                    </div><!-- .thumb-detalle-producto-->
                    <div class="detalles-producto d-flex flex-column">

                        <div class="detalle precio d-flex">
                            <p class="detalle-precio-producto">$<?= $producto->precio ?></p>
                            <?php if ($producto->oferta != 0) : ?>
                                <div class="descuento d-flex flex-column">
                                    <p class="precio-n">$35</p>
                                    <span>ahorras $10</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="detalle descripcion">
                            <h2><?= $producto->nombre; ?></h2>
                        </div>
                        <div class="detalle descripcion">
                            <h3> <?= $producto->descripcion ?></h3>
                        </div>
                        <div class="detalle detalle-2 d-flex">
                            <p class="Marca">Marca</p>
                            <span> Producto </span>
                        </div>
                        <div class="detalle detalle-2 d-flex">
                            <p class="disponibildiad">Disponibilidad</p>
                            <span>En estock! recibelo mañana </span>
                        </div>
                        <div class="detalle detalle-2 d-flex">
                            <p class="envio">Envio</p>
                            <span>Gratis! </span>
                        </div>
                        <div class="detalle caracteristicas">
                            <ul>
                                <li class="caracteristica">Lorem ipsum dolor sit amet.</li>
                                <li class="caracteristica">Lorem ipsum dolor sit amet.</li>
                                <li class="caracteristica">Lorem ipsum dolor sit amet.</li>
                                <li class="caracteristica">Lorem ipsum dolor sit amet.</li>
                                <li class="caracteristica">Lorem ipsum dolor sit amet.</li>
                            </ul>
                        </div>
                    </div><!-- .detalles-producto -->
                </div>
                <div class="detalle-compra w-50-center d-flex">
                    <p class="envio-1-dia">¿Quieres recibirlo <span>mañana</span> ? Cómpralo antes de <span>6 hrs y 11 mins</span> y elige <span>Envío 1 día</span> al completar tu pedido.</p>
                    <form action="<?= RUTA ?>carrito/add" method="post">
                        <div class="cantidad d-flex">
                            <label for="cantidad">Cantidad (<small>maximo 15 productos)</small></label>
                            <div class="mas-menos d-flex">
                                <!--  <button class="menos">-</button> -->
                                <input type="number" name="cantidad" id="cantidad" min="1" value="1" max="15">
                                <!--  <button class="mas">+</button> -->
                            </div>
                        </div>
                        <div class="botones-compras">
                            <!-- <input type="button" value="Comprar Ya!" class="btn btn-compra comprarYa" name="accion-compra"> -->
                            <input type="hidden" name="producto_id" value="<?= $producto->id ?>">
                            <input type="submit" value="Añadir al carrito" class="btn btn-compra comprarYa" name="añadirCarrito">
                        </div>
                    </form>
                </div><!-- .detalle-compra -->
            </div><!-- ./producto-detalles -->
        </div><!-- ./contenedor-main -->
    <?php else : ?>
        <p>Lo sentimos este producto no esta disponible.</p>
    <?php endif ?>
</main>