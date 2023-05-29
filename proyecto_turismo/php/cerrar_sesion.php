<?php
    session_start();
    unset($_SESSION['user']); //unset() dentro de una función, solo la variable local es destruida
    session_destroy();
    header("refresh:0; url=../index.html");
?>