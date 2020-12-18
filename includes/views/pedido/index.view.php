<main class="main-100 vh77-center d-flex flex-column flex-y-center">
    <h2>Gestionar Pedidos</h2>

    <div class="contenedor-main w-50-center d-flex flex-column h-100 bg-blanco">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto w-25">
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
        <div class="contenido d-flex flex-column flex-y-center">
            <table class="table table-v2 table-td_min_w_150">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Coste</td>
                        <td>Estado</td>
                        <td>Fecha</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($pedidos) && $pedidos->num_rows !== 0) : ?>
                        <?php while ($pedido = $pedidos->fetch_object()) : ?>
                            <tr>
                                <td><?= $pedido->id; ?></td>
                                <td class="f-numero">$<?= $pedido->coste; ?></td>
                                <td><?= $pedido->estado; ?></td>
                                <td><?= $pedido->fecha; ?></td>
                                <td>
                                    <a href="<?= RUTA ?>pedido/pedidoView&p=<?= $pedido->id ?>" class="btn btn-table-eliminar">Ver</a>
                                    <a href="<?= RUTA ?>pedido/eliminar&p=<?= $pedido->id ?>" class="btn btn-table-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td class="td-notifiacion">Oh no! todavia no tienes pedidos</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Id</td>
                        <td>Coste</td>
                        <td>Estado</td>
                        <td>Fecha</td>
                        <td>Acciones</td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div><!-- ./contenedor-main -->
</main>