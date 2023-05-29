<?php
if(!isset($_POST["nombre"]) ||
    !isset($_POST["correo"]) ||
    !isset($_POST["telefono"]) ||
    !isset($_POST["num_adultos"]) ||
    !isset($_POST["num_niños"]) ||
    !isset($_POST["fecha"]) ||
    !isset($_POST["lugares"]) ||
    !isset($_POST["actividades"])
)exit();

include_once "../bd/base_de_datos.php"; //include_once solamente se ejecuta una vez
$usuario = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$adultos = $_POST["num_adultos"];
$niños = $_POST["num_niños"];
$fecha = $_POST["fecha"];
$lugares = $_POST["lugares"];
$actividades = $_POST["actividades"];

$insertar = $base_de_datos->prepare("INSERT INTO reservacion (nombre,correo,telefono,num_adultos,num_niños,fecha,lugares,actividades) VALUES (?,?,?,?,?,?,?,?);");
$resultado_insertar = $insertar->execute([$usuario, $correo, $telefono, $adultos, $niños, $fecha, $lugares, $actividades]);

if($resultado_insertar === TRUE){
    echo "
    <script>
        alert('Gracias por reservar en Huasteca Tours!');
    </script>";
    header("Refresh:0; url=sesion.html");
    
}else{
echo "
    <script>
        alert('¡Error de formulario!...');
        alert('¡Error de conexión a base de datos!');
    </script>";
    header("Refresh:0; url=reservacion_usuario.html");
}
?>