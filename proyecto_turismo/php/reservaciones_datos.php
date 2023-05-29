<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

}else{
    echo "<script> alert('Debes de iniciar sesión.'); </script>";
    header("Refresh:0; url=loginvista.html");
exit;
}
$now = time();

if($now > $_SESSION['expire']) {
    session_destroy(); //destruyendo la variable session_start();
    header("Refresh:0; url=loginvista.html");
exit;
}
?>

<!-- Documento de seleccionar la tabla de datos -->
<?php
include_once "../bd/base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM reservacion;");
$solicitudes = $sentencia->fetchALL(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/icono-pagina.png">
    <link rel="icon" href="../images/loros.png">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <title><?php echo "Administrador: " . $_SESSION['user']; ?></title>
</head>

<body class="editar-usuario">
    <script src="../js/imagen.js"></script>
    <script src="../js/logout.js"></script>
    <div class="content2">
        <div class="nav-bg">
            <nav class="navegacion-principal">
                <a href="cerrar_sesion.php" class="enlace-logout" onclick="cerrar_sesion()">Cerrar Sesión</a>
            </nav>
        </div>
        <h2 class="usuarios-registrados1">Reservaciones de Usuarios</h2>
        <div class="menu-bienvenida">
            <a href="reservaciones_datos.php" class="registrar-admin1">Actualizar</a>
            <a href="menu_bienvenida.php" class="registrar-admin1">Datos del Administrador</a>
        </div>
        <br><br>
        <table>
            <thead>
                <tr>
                    <td>No. Identificador</td>
                    <td>Nombre Completo</td>
                    <td>Correo</td>
                    <td>Télefono</td>
                    <td>Adultos</td>
                    <td>Niños</td>
                    <td>Fecha</td>
                    <td>Lugar</td>
                    <td>Actividades</td>            
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($solicitudes as $solicitud) { ?>
                    <tr>
                        <td><?php echo $solicitud->id ?></td>
                        <td><?php echo $solicitud->nombre ?></td>
                        <td><?php echo $solicitud->correo ?></td>
                        <td><?php echo $solicitud->telefono ?></td>
                        <td><?php echo $solicitud->num_adultos ?></td>
                        <td><?php echo $solicitud->num_niños ?></td>
                        <td><?php echo $solicitud->fecha ?></td>
                        <td><?php echo $solicitud->lugares ?></td>
                        <td><?php echo $solicitud->actividades ?></td>
                        <td><a href="<?php echo "eliminar_reservacion.php?id=" . $solicitud->id ?>"><div class="delete-button"><img src="../images/eliminar-usuario.png" class="imagen-boton"></div></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>