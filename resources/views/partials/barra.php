<header>
    <div class="contenedor contenedor-header d-flex d-row">
        <div class="logo">
            <a href="<?php echo RUTA; ?>">
                <h1>ShoppinG!</h1>
            </a>
        </div>
        <div class="contenedor-utilidades d-flex">
            <div class="buscador">
                <form action="<?php echo RUTA; ?>buscar.php" method="get" name="busqueda" class="buscar">
                    <input type="text" name="buscar" id="buscar" placeholder="Buscar">
                    <button type="submit" class="icono fas fa-search"></button>
                </form>
            </div>
            <nav class="contenedor-i d-flex">
                <li>
                    <?php if (isset($_SESSION['usuario']) /* && $_SESSION['usuario']['state'] === true */) : ?>
                        <a href="<?= RUTA; ?>usuario/logOut"><i class="fas fa-sign-out-alt"></i></a>
                    <?php else : ?>
                        <a href="<?= RUTA; ?>usuario/iniciarSesion"><i class="fas fa-user"></i></i></a>
                    <?php endif ?>
                </li>
                <li>
                    <a href="<?= RUTA; ?>carrito/index"><i class="fas fa-shopping-cart"></i></i></a>
                </li>
            </nav>
        </div>
        <!--<div class="burguer">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div> -->
    </div>
</header>