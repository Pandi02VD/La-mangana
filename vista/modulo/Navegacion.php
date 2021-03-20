<nav>
    <!-- <ul>
        <li> -->
            <div class="D-Logo">
                <img class="Logo" src="img/LogoNombre_G.png" alt="Logotipo">
            </div>
            <div class="D-link-buttons">
                <?php if(isset($_GET["pagina"])) : ?>
                    <?php if(!isset($_SESSION["ingresado"])) : ?>
                        <?php if($_GET["pagina"] == "IniciarSesion") { ?>
                            <a class="link-button activo" href="index.php?pagina=IniciarSesion">Iniciar Sesión</a>
                        <?php }else{ ?>
                            <a class="link-button" href="index.php?pagina=IniciarSesion">Iniciar Sesión</a>
                        <?php } ?>
                    <?php endif ?>
                    <!--</li>
                    -->
                    <?php if(isset($_SESSION["ingresado"])) : ?>
                        <?php if($_GET["pagina"] == "Inicio") { ?>
                            <a class="link-button activo" href="index.php?pagina=Inicio">Inicio</a>
                        <?php }else{ ?>
                            <a class="link-button" href="index.php?pagina=Inicio">Inicio</a>
                        <?php } ?>
                        
                        <?php if($_GET["pagina"] == "Mascotas" || $_GET["pagina"] == "MascotasCliente" || $_GET["pagina"] == "HistoriaClinica") { ?>
                            <a class="link-button activo" href="index.php?pagina=Mascotas">Mascotas</a>
                        <?php }else{ ?>
                            <a class="link-button" href="index.php?pagina=Mascotas">Mascotas</a>
                        <?php } ?>
                        
                        <?php if($_GET["pagina"] == "Usuarios" || $_GET["pagina"] == "Clientes" || $_GET["pagina"] == "Usuario") { ?>
                            <a class="link-button activo" href="index.php?pagina=Clientes">Clientes & Usuarios</a>
                        <?php }else{ ?>
                            <a class="link-button" href="index.php?pagina=Clientes">Clientes & Usuarios</a>
                        <?php } ?>
                    <?php endif ?>
                <?php endif ?>
            </div>
        <!-- </li>
        <li> -->
            <?php if(isset($_SESSION["ingresado"])) : ?>
                <div class="saludo">
                    <a class="link-button" href="index.php?pagina=Salir">Salir</a>
                </div>
                <div class="saludo">
                    <span id="saludo">¡Hola</span><?="! ".$_SESSION["ingresado"]?>
                </div>
            <?php endif ?>
        <!-- </li>
    </ul> -->
</nav>