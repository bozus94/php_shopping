<main class="main-100 vh77-center d-flex flex-column">
    <h2> Realizar pedido</h2>
    <div class="contenedor-main d-flex flex-row flex-y-center h-100">
        <div class="contenedor-main-header d-flex w-100 flex-y-center">
            <div class="bg-blanco mr-auto">
                <a href="<?= RUTA ?>categoria/index" class="btn-contenedor-main-header"><i class="fas fa-arrow-left"></i></a>
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
        <div class="formulario bg-blanco">
            <form action="<?= RUTA ?>pedido/add" method="post" enctype="multipart/form-data">
                <select id="busqueda_provincia" class="form-control" name="provincia">
                    <option value='alava'>Álava</option>
                    <option value='albacete'>Albacete</option>
                    <option value='alicante'>Alicante/Alacant</option>
                    <option value='almeria'>Almería</option>
                    <option value='asturias'>Asturias</option>
                    <option value='avila'>Ávila</option>
                    <option value='badajoz'>Badajoz</option>
                    <option value='barcelona'>Barcelona</option>
                    <option value='burgos'>Burgos</option>
                    <option value='caceres'>Cáceres</option>
                    <option value='cadiz'>Cádiz</option>
                    <option value='cantabria'>Cantabria</option>
                    <option value='castellon'>Castellón/Castelló</option>
                    <option value='ceuta'>Ceuta</option>
                    <option value='ciudadreal'>Ciudad Real</option>
                    <option value='cordoba'>Córdoba</option>
                    <option value='cuenca'>Cuenca</option>
                    <option value='girona'>Girona</option>
                    <option value='laspalmas'>Las Palmas</option>
                    <option value='granada'>Granada</option>
                    <option value='guadalajara'>Guadalajara</option>
                    <option value='guipuzcoa'>Guipúzcoa</option>
                    <option value='huelva'>Huelva</option>
                    <option value='huesca'>Huesca</option>
                    <option value='illesbalears'>Illes Balears</option>
                    <option value='jaen'>Jaén</option>
                    <option value='acoruña'>A Coruña</option>
                    <option value='larioja'>La Rioja</option>
                    <option value='leon'>León</option>
                    <option value='lleida'>Lleida</option>
                    <option value='lugo'>Lugo</option>
                    <option value='madrid'>Madrid</option>
                    <option value='malaga'>Málaga</option>
                    <option value='melilla'>Melilla</option>
                    <option value='murcia'>Murcia</option>
                    <option value='navarra'>Navarra</option>
                    <option value='ourense'>Ourense</option>
                    <option value='palencia'>Palencia</option>
                    <option value='pontevedra'>Pontevedra</option>
                    <option value='salamanca'>Salamanca</option>
                    <option value='segovia'>Segovia</option>
                    <option value='sevilla'>Sevilla</option>
                    <option value='soria'>Soria</option>
                    <option value='tarragona'>Tarragona</option>
                    <option value='santacruztenerife'>Santa Cruz de Tenerife</option>
                    <option value='teruel'>Teruel</option>
                    <option value='toledo'>Toledo</option>
                    <option value='valencia'>Valencia/Valéncia</option>
                    <option value='valladolid'>Valladolid</option>
                    <option value='vizcaya'>Vizcaya</option>
                    <option value='zamora'>Zamora</option>
                    <option value='zaragoza'>Zaragoza</option>
                </select>
                <input type="text" name="localidad" id="localidad" class="form-control" placeholder="localidad">
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="direccion">
                <div class="footer-form">
                    <div class="btn-group d-flex flex-column ">
                        <input type="hidden" name="usuarioId" value="<?= $_SESSION['login']['usuario']->id ?>">
                        <input type="hidden" name="coste" value="<?= Utils::statsCarrito()['total'] ?>">
                        <input type="hidden" name="estado" value="pendiente">
                        <input type="submit" value="Realizar pedido" class="btn btn-submit btn-hover w-50-center" name="submit">
                    </div>
                </div><!-- ./footer-form -->
            </form><!-- ./form -->
        </div><!-- ./formulario -->
    </div><!-- ./contenedor_main -->
</main>