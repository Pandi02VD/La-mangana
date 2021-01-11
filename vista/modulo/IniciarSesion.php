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
    </div>
        <?php 
            $entrar = Controlador::iniciarSesionCtl();
        ?>
</form>
