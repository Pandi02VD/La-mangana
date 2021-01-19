<h1>Iniciar Sesión</h1>

<form method="post">
    <div>
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario">
    </div>
    
    <div>
        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    
    <div>
        <input type="submit" value="Iniciar">
        <a href="index.php?pagina=CrearCuenta">No tengo cuenta</a>
    </div>
        <?php 
            $entrar = Controlador::iniciarSesionCtl();
        ?>
</form>
