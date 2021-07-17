<div style="background-color: rgb(238, 232, 232)">
    <nav>
        <div class="D-Logo">
            <img class="Logo" src="img/LogoNombre_G.png" alt="Logotipo">
        </div>
        <div class="mainTitle">La Mangana</div>
        <?php if(isset($_SESSION["ingresado"])) : ?>
            <div class="saludo">
                <a class="link-button" href="index.php?pagina=Salir">Salir</a>
            </div>
            <div class="saludo">
                <span id="saludo">¡Hola</span><?="! ".$_SESSION["ingresado"]?>
            </div>
        <?php endif ?>
    </nav>
    
    <div class="buttonsBar">
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
                    <?php if($_GET["pagina"] == "Inicio" || $_GET["pagina"] == "index") { ?>
                        <a class="link-button activo" href="index.php?pagina=Inicio">Inicio</a>
                    <?php }else{ ?>
                        <a class="link-button" href="index.php?pagina=Inicio">Inicio</a>
                    <?php } ?>
                    
                    <?php if(
                        $_GET["pagina"] == "Mascotas" || $_GET["pagina"] == "MascotasCliente" || $_GET["pagina"] == "HistoriaClinica" || $_GET["pagina"] == "Mascota"
                        ) { ?>
                        <a class="link-button activo" href="index.php?pagina=Mascotas">Mascotas</a>
                    <?php }else{ ?>
                        <a class="link-button" href="index.php?pagina=Mascotas">Mascotas</a>
                    <?php } ?>
                    
                    <?php if(
                        $_GET["pagina"] == "Usuarios" || $_GET["pagina"] == "Clientes" || 
                        $_GET["pagina"] == "Usuario" || $_GET["pagina"] == "Cliente"
                        ) { ?>
                        <a class="link-button activo" href="index.php?pagina=Clientes">Clientes & Usuarios</a>
                    <?php }else{ ?>
                        <a class="link-button" href="index.php?pagina=Clientes">Clientes & Usuarios</a>
                    <?php } ?>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>
</div>
        <!-- </li>
        <li> -->
            
        <!-- </li>
    </ul> -->
<!-- <nav> -->
    <!-- <ul>
        <li> -->
            <!-- <div class="D-Logo">
                <img class="Logo" src="img/LogoNombre_G.png" alt="Logotipo">
            </div> -->
            <!-- <div class="D-link-buttons"> -->
                <?php if(isset($_GET["pagina"])) : ?>
                    <?php if(!isset($_SESSION["ingresado"])) : ?>
                        <?php if($_GET["pagina"] == "IniciarSesion") { ?>
                            <!-- <a class="link-button activo" href="index.php?pagina=IniciarSesion">Iniciar Sesión</a> -->
                        <?php }else{ ?>
                            <!-- <a class="link-button" href="index.php?pagina=IniciarSesion">Iniciar Sesión</a> -->
                        <?php } ?>
                    <?php endif ?>
                    <!--</li>
                    -->
                    <?php if(isset($_SESSION["ingresado"])) : ?>
                        <?php if($_GET["pagina"] == "Inicio") { ?>
                            <!-- <a class="link-button activo" href="index.php?pagina=Inicio">Inicio</a> -->
                        <?php }else{ ?>
                            <!-- <a class="link-button" href="index.php?pagina=Inicio">Inicio</a> -->
                        <?php } ?>
                        
                        <?php if(
                            $_GET["pagina"] == "Mascotas" || $_GET["pagina"] == "MascotasCliente" || $_GET["pagina"] == "HistoriaClinica" || $_GET["pagina"] == "Mascota"
                            ) { ?>
                            <!-- <a class="link-button activo" href="index.php?pagina=Mascotas">Mascotas</a> -->
                        <?php }else{ ?>
                            <!-- <a class="link-button" href="index.php?pagina=Mascotas">Mascotas</a> -->
                        <?php } ?>
                        
                        <?php if(
                            $_GET["pagina"] == "Usuarios" || $_GET["pagina"] == "Clientes" || 
                            $_GET["pagina"] == "Usuario" || $_GET["pagina"] == "Cliente"
                            ) { ?>
                            <!-- <a class="link-button activo" href="index.php?pagina=Clientes">Clientes & Usuarios</a> -->
                        <?php }else{ ?>
                            <!-- <a class="link-button" href="index.php?pagina=Clientes">Clientes & Usuarios</a> -->
                        <?php } ?>
                    <?php endif ?>
                <?php endif ?>
            <!-- </div> -->
        <!-- </li>
        <li> -->
            <?php if(isset($_SESSION["ingresado"])) : ?>
                <!-- <div class="saludo">
                    <a class="link-button" href="index.php?pagina=Salir">Salir</a>
                </div>
                <div class="saludo">
                    <span id="saludo">¡Hola</span><?="! ".$_SESSION["ingresado"]?>
                </div> -->
            <?php endif ?>
        <!-- </li>
    </ul> -->
<!-- </nav> -->