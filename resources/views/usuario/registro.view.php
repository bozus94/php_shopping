<main class="main-100 vh77-center d-flex flex-column">
  <h2>Registrate!</h2>
  <div class="contenedor-main d-flex flex-column flex-y-center h-100 formulario bg-blanco">
    <div class="contenedor-main-header d-flex w-100 flex-y-center">
      <div class="bg-blanco mr-auto mr-5">
        <a href="<?= RUTA ?>" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
      </div>
      <?php if (isset($_SESSION[$this->session])) : ?>
        <h3 class="alert alert-error"><?= $_SESSION[$this->session]['message'] ?></h3>
        <?php Utils::deleteSession($this->session); ?>
      <?php endif; ?>
    </div><!-- ./contenedor-main-header -->
    <div class="box-shadow formulario-2 w-100">
      <!-- notificacion del registro -->
      <form action="<?= RUTA; ?>usuario/guardar" method="post" enctype="multipart/form-data">
        <?php if (isset($respuesta)) : ?>
          <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $respuesta['usuario'] ?>">
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $respuesta['password'] ?>">
        <?php else : ?>
          <input type="text" name="nombre" id="usuario" class="form-control" placeholder="Nombre">
          <input type="text" name="apellidos" id="password" class="form-control" placeholder="Apellidos">
          <input type="email" name="email" id="usuario" class="form-control" placeholder="Email">
          <input type="password" name="password" id="usuario" class="form-control" placeholder="Password">
          <input type="text" name="rol" id="usuario" class="form-control" placeholder="Rol">
          <input type="file" name="imagen" id="usuario" class="imagen-form form-control">
        <?php endif ?>

        <div class="footer-form">
          <div class="btn-group d-flex flex-column ">
            <input type="submit" value="Registrarse" class="btn btn-submit btn-hover w-50-center" name="registro">
            <a href="<?= RUTA; ?>usuario/iniciarSesion" class="btn btn-secundario">ya tienes cuenta, inicia sesion!</a>
          </div>
          <?php if (!empty($respuesta['errores'])) : ?>
            <div class="error">
              <ul>
                <?php echo $respuesta['errores']; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
</main>