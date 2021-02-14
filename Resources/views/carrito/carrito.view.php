<main class="main-100 vh77-center d-flex flex-column flex-y-center justify-center">
    <div class="contenedor-main w-50-center d-flex flex-column h-100 bg-blanco">
        <div class="contenido d-flex flex-column flex-y-center">
            <?php if ($stats['count'] == 0) : ?>
                <h3>El carrito esta vacio</h3>
            <?php else : ?>
                <h3>(<?= $stats['count'] ?>) productos del carrito</h3>
            <?php endif; ?>

            <?php if (isset($_SESSION['carrito'])) : ?>
                <table class="table table-v3">
                    <tbody>
                        <?php foreach ($_SESSION['carrito'] as $indice => $elemento) : ?>
                            <tr>
                                <td>
                                    <?php if ($elemento['producto']->imagen == null) : ?>
                                        <a href="<?= RUTA ?>producto/productoView&prod=<?= $elemento['id_producto'] ?>"><img src="<?= RUTA; ?>assets/img/new-product2.jpg" alt="producto"></a>
                                    <?php else : ?>
                                        <a href="<?= RUTA ?>producto/productoView&prod=<?= $elemento['id_producto'] ?>"><img src="<?= RUTA; ?>uploads/images/<?= $elemento['producto']->imagen; ?>" alt="producto"></a>
                                    <?php endif; ?>
                                </td>
                                <td><?= $elemento['producto']->nombre; ?></td>
                                <td><?= $elemento['cantidad'] ?></td>
                                <td>$<?= $elemento['producto']->precio * $elemento['cantidad'] ?></td>
                                <td> <a href="<?= RUTA ?>carrito/delete&prod=<?= $indice ?>" class="table-i"><i class="far fa-trash-alt"></i></a> </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="tbl-total d-flex w-100">
                    <p>Total</p>
                    <p>$<?= $stats['total'] ?></p>
                </div>
                <div class="btn-group d-flex w-100">
                    <a href="<?= RUTA ?>" class="btn btn-hover btn-Scomprando">Seguir comprando</a>
                    <?php if (isset($_SESSION['login'])) : ?>
                        <a href="<?= RUTA ?>pedido/crear" class="btn btn-hover btn-Ppedido">Realizar pedido</a>
                    <?php else : ?>
                        <a href="<?= RUTA ?>usuario/iniciarSesion" class="btn btn-Ppedido-b">Realizar pedido</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>


        </div>
    </div>
</main>