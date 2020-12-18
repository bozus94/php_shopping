<main class="main-100 vh77-center d-flex flex-column">
    <h2> Mis Pedidos</h2>
    <div class="contenedor-main d-flex flex-column flex-y-center h-100 bg-blanco">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto">
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
        <table class="table table-v2 table-td_min_w_150">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Coste</td>
                    <td>Estado</td>
                    <td>Fecha</td>
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
                            <td><a href="<?= RUTA ?>pedido/pedidoView&p=<?= $pedido->id ?>" class="btn">ver</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="4">Oh no! todavia no tienes pedidos</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>Id</td>
                    <td>Coste</td>
                    <td>Estado</td>
                    <td>Fecha</td>
                </tr>
            </tfoot>

        </table>
    </div><!-- ./contenedor_main -->
</main>