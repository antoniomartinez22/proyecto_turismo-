<?php
session_start(); /*Creamos sesiones de trabajo*/
?>
<?php
$correo = $_POST['user'];
$pass = $_POST['password'];
$conexion = mysqli_connect("localhost","root","","turismo");
$consulta = "SELECT *
            FROM usuario
            WHERE   correo = '$correo'
            AND pass = '$pass'";

$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);

if($filas>0){
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $correo;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60); //10 minutos
if($correo == TRUE){
    header("location:sesion.html");
}
}
else{
    echo '<script>alert("¡La contraseña no es la correcta, intente de nuevo!");</script>';
    header("Refresh:0; url=login_usuario.html");
}
mysqli_free_result($resultado);
mysqli_close($conexion);