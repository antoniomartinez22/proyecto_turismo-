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
<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../bd/base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM administrador WHERE id = ?;");
$sentencia->execute([$id]);
$solicitud = $sentencia->fetch(PDO::FETCH_OBJ);
if($solicitud === FALSE){
	echo "¡No existe alguna solicitud con ese ID!";
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/loros.png">
    <!-- <link rel="stylesheet" href="../css/hoja_estilo.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <title>Editar Usuario</title>
</head>
<body class="editar-usuario">
<script src="../js/logout.js"></script>
<div class="nav-bg">
        <nav class="navegacion-principal">
            <a href="cerrar_sesion.php" class="enlace-logout" onclick="cerrar_sesion()">Cerrar Sesión</a>
        </nav>
    </div>
    <h2 class="usuarios-registrados">Editar Administrador</h2>
    <div class="menu-bienvenida">
        <a href="menu_bienvenida.php" class="registrar-admin">Inicio</a>
        <a href="registravista.html" class="registrar-admin" >Registrar administrador</a>
    </div>
    <br><br>
    <div class="informacion">
    <div class="form-editar">
        <form action="actualizar_informacion.php" method="post" class="formulario-editar">
            <div class="id">
                <label for="id-input">No. Identificador:</label>
                <br>
                <input type="text" value="<?php echo $solicitud->id ?>" name="id" id="id-input" class="input-formulario-id" readonly>
            </div>
            <div class="nombrec">
                <label for="nombrec-input">Nombre Completo:</label>
                <br>
                <input type="text" value="<?php echo $solicitud->nombre?>" name="nombre" id="nombre-input" class="input-formulario">
            </div>
            <div class="correogoogle">
                <label for="correo-input">Correo Electrónico:</label>
                <br>
                <input type="email" value="<?php echo $solicitud->correo?>" name="correo" id="correo-input" class="input-correo">
            </div>
            <div class="passgoogle">
                <label for="pass-input">Contraseña:</label>
                <br>
                <input type="text" value="<?php echo $solicitud->pass?>" name="pass" id="pass-input" class="input-formulario">
            </div>
            <div class="submit">
                <input type="submit" value="Actualizar Información" class="actualizar-datos">
            </div>
        </form>
    </div>
</div>
</body>
</html>