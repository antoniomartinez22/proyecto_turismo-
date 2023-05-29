<?php
if(!isset($_POST["nombre"]) ||
    !isset($_POST["correo"]) ||
    !isset($_POST["pass"])
)exit();

include_once "../bd/base_de_datos.php"; //include_once solamente se ejecuta una vez
$administrador = $_POST["nombre"];
$correo = $_POST["correo"];
$pass = $_POST["pass"];

$insertar = $base_de_datos->prepare("INSERT INTO administrador (nombre,correo,pass) VALUES (?,?,?);");
$resultado_insertar = $insertar->execute([$administrador, $correo, $pass]);

if($resultado_insertar === TRUE){
    echo "
    <script>
        alert('Tu cuenta ha sido creada con exito...');
    </script>";
    header("Refresh:0; url=loginvista.html");
    
}else{
echo "
    <script>
        alert('¡Error de formulario!...');
        alert('¡Error de conexión a base de datos!');
    </script>";
    header("Refresh:0; url=crear_cuenta.html");
}
?>