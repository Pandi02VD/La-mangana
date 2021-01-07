<?php $usuarios = Controlador::seleccionarUsuariosCtl(); ?>
<h1>Inicio</h1>
<a href="index.php?pagina=IniciarSesion">Iniciar Sesión</a>
<table>
    <tr>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
        <?php foreach($usuarios as $key => $value) { ?>
    <tr>
        <td style="background: pink"><?=$value["nombre"]?></td>
        <td style="background: pink"><?=$value["usuario"]?></td>
        <td style="background: pink"><?=$value["contrasena"]?></td>
        <td style="background: pink"><?=$value["fecha"]?></td>
        <td style="background: pink"><?=$value["status"]?></td>
    </tr>
        <?php } ?>
</table>