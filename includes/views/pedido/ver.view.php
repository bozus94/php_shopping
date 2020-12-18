<main class="main-100 vh77-center d-flex flex-column">
    <h2>Tu pedido</h2>
    <!-- 
    <?php Utils::preDump($_SESSION); ?> -->
    <div class="contenedor-main d-flex flex-column flex-y-center h-100 bg-blanco">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto mr-5">
                <a href="<?= RUTA ?>pedido/pedidos" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
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
        <!-- isset$_SESSION'pedido' -->
        <div class="contenido">
            <?php if (Utils::isAdmin()) : ?>
                <div class="formulario formulario-min ">
                    <form action="<?= RUTA ?>pedido/editar" method="post" enctype="multipart/form-data">
                        <select name="estado" id="estado" class="form-control">
                            <option value="pendiente" <?= $pedido->estado == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="preparando" <?= $pedido->estado == 'preparando' ? 'selected' : '' ?>>Preparando</option>
                            <option value="prepaenviar" <?= $pedido->estado == 'prepaenviar' ? 'selected' : '' ?>>Preparado para enviar</option>
                            <option value="enviado" <?= $pedido->estado == 'enviado' ? 'selected' : '' ?>>Enviado</option>
                            <option value="entregado" <?= $pedido->estado == 'entregado' ? 'selected' : '' ?>>Entregado</option>
                        </select>
                        <input type="hidden" name="id" value="<?= $pedido->id ?>">
                        <input type="submit" value="Modificar" class="btn btn-submit btn-hover w-50-center" name="submit">
                    </form><!-- ./form -->
                </div><!-- ./formulario -->
            <?php endif; ?>
            <div class="d-flex flex-row justify-around w-100 p-5 flex-y-center p-relative">
                <div class="info-pedido d-flex flex-column flex-y-center ">
                    <h3 class="d-block">Datos de facturacion</h3>
                    <p>Provincia: <?= $pedido->provincia ?></p>
                    <p>Localidad: <?= $pedido->localidad ?></p>
                    <p>Direccion: <?= $pedido->direccion ?></p>
                </div>
                <div class="separador-y p-absolute"></div>
                <div class="info-pedido d-flex flex-column flex-y-center ">
                    <h3 class="d-block">Datos del envio</h3>
                    <p>Numero de pedido: <span class="f-numero"><?= $pedido->id ?></span> </p>
                    <p>Coste: <strong><span class="f-numero">$<?= $pedido->coste ?></span></strong></p>
                    <p>Estado: <strong><?= ucfirst($pedido->estado) ?></strong></p>
                </div>
            </div>
            <table class="table table-v3 table-td_min_w_150">
                <thead>
                    <td>Imagen</td>
                    <td>Nombre</td>
                    <td>Stock</td>
                    <td>Precio</td>
                    <td>Unidades</td>
                </thead>
                <tbody>
                    <?php if (isset($prods_pedido)) : ?>
                        <?php while ($pro = $prods_pedido->fetch_object()) : ?>
                            <tr>
                                <td>
                                    <?php if ($pro->imagen == null) : ?>
                                        <a href="<?= RUTA ?>producto/productoView&prod=<?= $pro->id ?>"><img src="<?= RUTA; ?>assets/img/new-product2.jpg" alt="producto"></a>
                                    <?php else : ?>
                                        <a href="<?= RUTA ?>producto/productoView&prod=<?= $pro->id ?>"><img src="<?= RUTA; ?>uploads/images/<?= $pro->imagen; ?>" alt="producto"></a>
                                    <?php endif; ?>
                                </td>
                                <td><?= $pro->nombre; ?></td>
                                <td class="f-numero"><?= $pro->stock; ?></td>
                                <td class="f-numero"><?= $pro->precio; ?></td>
                                <td class="f-numero"><?= $pro->unidades; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <p class="alert alert-info alert-w-100">El estado de tu pedido esta en pendiente, debes ingresar el importe total al numero de cuenta <strong>#045D985VQ4</strong>, para poder porcesarlo, en el concepto debes poner el numero de tu pedido. </p>
        </div>

    </div><!-- ./contenedor_main -->
</main>