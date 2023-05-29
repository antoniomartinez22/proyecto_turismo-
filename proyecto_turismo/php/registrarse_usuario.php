<?php
if(!isset($_POST["nombre"]) ||
    !isset($_POST["correo"]) ||
    !isset($_POST["pass"])
)exit();

include_once "../bd/base_de_datos.php"; //include_once solamente se ejecuta una vez
$usuario = $_POST["nombre"];
$correo = $_POST["correo"];
$pass = $_POST["pass"];

$insertar = $base_de_datos->prepare("INSERT INTO usuario (nombre,correo,pass) VALUES (?,?,?);");
$resultado_insertar = $insertar->execute([$usuario, $correo, $pass]);

if($resultado_insertar === TRUE){
    echo "
    <script>
        alert('Tu cuenta ha sido creada con exito...');
    </script>";
    header("Refresh:0; url=login_usuario.html");
    
}else{
echo "
    <script>
        alert('¡Error de formulario!...');
        alert('¡Error de conexión a base de datos!');
    </script>";
    header("Refresh:0; url=registro_usuario.html");
}
?>