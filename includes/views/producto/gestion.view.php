<main class="main-100 vh77-center d-flex flex-column flex-y-center justify-center">
    <h2>Gestionar Productos</h2>
    <div class="contenedor-main w-50-center d-flex flex-column h-100 bg-blanco">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto mr-5">
                <a href="<?= RUTA ?>" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
                <a href="<?= RUTA ?>/producto/crear" class="btn-contenedor-main-header"><i class="fas fa-plus"></i></a>
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
            <table class="table table-v2">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>descripcion</td>
                        <td>stock</td>
                        <td>precio</td>
                        <td>oferta</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($pro = $productos->fetch_object()) : ?>
                        <tr>
                            <!--  -->
                            <td><?= $pro->id; ?></td>
                            <td><?= $pro->nombre; ?></td>
                            <td><?= $pro->descripcion; ?></td>
                            <td><?= $pro->stock; ?></td>
                            <td><?= $pro->precio; ?></td>
                            <td><?= $pro->oferta; ?></td>
                            <td>
                                <a href="<?= RUTA ?>producto/editar&id=<?= $pro->id; ?>" class="btn btn-table-editar">Editar</a>
                                <a href="<?= RUTA ?>producto/eliminar&id=<?= $pro->id; ?>" class="btn btn-table-eliminar">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>descripcion</td>
                        <td>stock</td>
                        <td>precio</td>
                        <td>oferta</td>
                        <td>Acciones</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</main>