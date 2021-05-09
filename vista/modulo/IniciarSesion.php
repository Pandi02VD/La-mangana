<?php
    if((isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=Inicio"</script>';
    }else{
    }
?>
<div class="title">
<h3>Inicia sesión para continuar</h3>
</div>
<div class="C__F">
    <form method="post" class="F">
        <h2 class="f__title">Iniciar Sesión</h2>
        <div class="line-top"></div>
        <div class="C__F__C">
            <div class="i__group">
                <input class="inputs" type="text" id="usuario" name="usuario" autofocus>
                <label class="labels" for="usuario">Usuario</label>
            </div>
            
            <div class="i__group">
                <input class="inputs" type="password" id="contrasena" name="contrasena">
                <label class="labels" for="contrasena">Contraseña</label>
            </div>
            
            <input class="submit" type="submit" value="Iniciar">
        </div>
            <?php 
                $entrar = ControladorUsuario::iniciarSesionCtl();
            ?>
    </form>
</div>