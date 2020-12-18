<main class="main-100 vh77-center d-flex flex-column">
  <h2>Inicio Sesion</h2>
  <div class="contenedor-main d-flex flex-column flex-y-center h-100 formulario bg-blanco">
    <div class="contenedor-main-header d-flex w-100 flex-y-center">
      <div class="bg-blanco mr-auto mr-5">
        <a href="<?= RUTA ?>" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
      </div>
      <?php if (isset($_SESSION[$this->session])) : ?>
        <?php if ($_SESSION[$this->session]['state'] === true && isset($_SESSION[$this->session]['newReg'])) : ?>
          <h3 class="alert alert-success"><?= $_SESSION[$this->session]['newReg'] ?></h3>
        <?php else : ?>
          <h3 class="alert alert-error "><?= $_SESSION[$this->session]['message'] ?></h3>
        <?php endif; ?>
        <?php Utils::deleteSession($this->session); ?>
      <?php endif; ?>
    </div><!-- ./contenedor-main-header -->
    <div class="box-shadow formulario-2 w-100">
      <!-- notificacion del login -->
      <form action="<?php echo RUTA; ?>usuario/login" method="post">
        <?php if (isset($respuesta)) : ?>
          <input type="email" name="usuario" id="usuario" class="form-control" value="<?php echo $respuesta['usuario'] ?>">
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $respuesta['password'] ?>">
        <?php else : ?>
          <input type="email" name="usuario" id="usuario" class="form-control" placeholder="correo@correo.com">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <?php endif ?>
        <div class="footer-form">
          <div class="btn-group d-flex flex-column ">
            <input type="submit" value="Iniciar Sesion" class="btn btn-submit btn-hover w-50-center" name="login">
            <a href="<?= RUTA; ?>usuario/registro" class="btn btn-secundario">no tienes cuenta, registrate!</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>