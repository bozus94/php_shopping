<main class="main-100 vh77-center d-flex flex-column flex-y-center">
    <h2>Gestionar categorias</h2>

    <div class="contenedor-main w-50-center d-flex flex-column h-100 bg-blanco">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto w-25">
                <a href="<?= RUTA ?>" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
                <a href="<?= RUTA ?>categoria/crear" class="btn-contenedor-main-header"><i class="fas fa-plus"></i></a>
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
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cat = $categorias->fetch_object()) : ?>
                        <tr>
                            <!--  -->
                            <td><?= $cat->id; ?></td>
                            <td><?= $cat->nombre; ?></td>
                            <td>
                                <a href="<?= RUTA ?>categoria/editar&cat=<?= $cat->id ?>" class="btn btn-table-editar">Editar</a>
                                <a href="<?= RUTA ?>categoria/eliminar&cat=<?= $cat->id ?>" class="btn btn-table-eliminar">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Acciones</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><!-- ./contenedor-main -->
</main>