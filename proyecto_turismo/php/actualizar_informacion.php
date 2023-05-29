<?php
    if(
        !isset($_POST["nombre"])||
        !isset($_POST["correo"])||
        !isset($_POST["pass"])||
        !isset($_POST["id"])
    )exit();

    include_once "../bd/base_de_datos.php";

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["correo"];
    $pass = $_POST["pass"];

    $sql = $base_de_datos->prepare("UPDATE administrador SET nombre = ?, correo = ?, pass = ? WHERE id = ?;");
    $ejecuta = $sql->execute([$nombre, $email, $pass, $id]);

    if($ejecuta == true){
        header("refresh:0; url=menu_bienvenida.php");
    }else{
        echo "<h2>Algo salio mal, verifica que la tabla exista</h2>";
    }