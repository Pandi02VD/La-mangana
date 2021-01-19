<h1>Crear Cuenta</h1>

<form method="post">
    <div>
        <label for="tipo-usuario">Tipo de usuario</label>
        <select name="tipo-usuario" id="tipo-usuario">
            <option value="">Seleccione tipo de usuario</option>
            <option value="2">Asistente</option>
            <option value="3">Médico</option>
        </select>
    </div>
    
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre">
    </div>

    <div>
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario">
    </div>
    
    <div>
        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    
    <div>
        <input type="submit" value="Crear">
        <a href="index.php?pagina=IniciarSesion">Ya tengo una cuenta</a>
    </div>
        <?php 
            $crearUsuario = Controlador::crearCuentaCtl();
        ?>
</form>
