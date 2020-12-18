<main class="main-100 vh77-center d-flex flex-column">
    <h2>Confirmacion</h2>
    <div class="contenedor-main d-flex flex-column flex-y-center h-100 bg-blanco">
        <?php if (isset($_SESSION['pedido'])) : ?>
            <?php if ($_SESSION['pedido']['estate'] == 'completed') : ?>
                <p class="alert alert-success alert-pedido alert-animado">Tu pedido se ha creado correctamente.</p>
                <?php if (isset($pedido) && is_object($pedido)) : ?>
                    <div class="info-pedido d-flex flex-row flex-y-center ">
                        <p>Numero de pedido: <span class="f-numero"><?= $pedido->id ?></span> </p>
                        <p>Coste: <strong><span class="f-numero">$<?= $pedido->coste ?></span></strong></p>
                        <p>Estado: <strong><?= $pedido->estado ?></strong></p>
                    </div>
                    <table class="table table-v3 table-td_min_w_150">
                        <tbody>
                            <?php if (isset($productos)) : ?>
                                <?php while ($pro = $productos->fetch_object()) : ?>
                                    <tr>
                                        <td>
                                            <?php if ($pro->imagen == null) : ?>
                                                <a href="<?= RUTA ?>producto/productoView&prod=<?= $pro->id ?>"><img src="<?= RUTA; ?>assets/img/new-product2.jpg" alt="producto"></a>
                                            <?php else : ?>
                                                <a href="<?= RUTA ?>producto/productoView&prod=<?= $pro->id ?>"><img src="<?= RUTA; ?>uploads/images/<?= $pro->imagen; ?>" alt="producto"></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $pro->nombre; ?></td>
                                        <td><?= $pro->stock; ?></td>
                                        <td><?= $pro->precio; ?></td>
                                        <td><?= $pro->unidades; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <p class="alert alert-info">El estado de tu pedido esta en pendiente, debes ingresar el importe total al numero de cuenta <strong>#045D985VQ4</strong>, para poder porcesarlo, en el concepto debes poner el numero de tu pedido. </p>
                <?php endif; ?>
                <!-- comporbacion de $pedido -->
            <?php else : ?>
                <p class="alert alert-error">Oh no! ocurrio un error al crear tu pedido, intentalo denuevo.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div><!-- ./contenedor_main -->
</main>