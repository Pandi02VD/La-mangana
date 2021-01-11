<nav>
    <!-- <ul>
        <li> -->
            <?php if(!isset($_SESSION["ingresado"])) : ?>
            <a href="index.php?pagina=IniciarSesion">Iniciar Sesión</a>
            <?php endif ?>
        <!-- </li>
        <li> -->
            <a href="index.php?pagina=Inicio">Inicio</a>
        <!-- </li>
        <li> -->
            <?php if(isset($_SESSION["ingresado"])) : ?>
            <a href="index.php?pagina=Salir">Salir</a>
            <?php endif ?>
        <!-- </li>
    </ul> -->
</nav>