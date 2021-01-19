<nav>
    <!-- <ul>
        <li> -->
            <?php if(!isset($_SESSION["ingresado"])) : ?>
            <a href="index.php?pagina=IniciarSesion">Iniciar Sesión</a>
            <?php endif ?>
        <!-- </li>
        <li> -->
            <a href="index.php?pagina=Inicio">Inicio</a>
            <a href="index.php?pagina=Mascotas">Mascotas</a>
            <a href="index.php?pagina=Usuarios">Usuarios</a>
        <!-- </li>
        <li> -->
            <?php if(isset($_SESSION["ingresado"])) : ?>
            <a href="index.php?pagina=Salir">Salir</a>
            <div><span id="saludo">Hola</span> <?=$_SESSION["ingresado"]?> </div>
            <?php endif ?>
        <!-- </li>
    </ul> -->
</nav>