<?php
include("conexion.class.php");
$activation_key = $_GET["activation"];

$db = Conexion::conectar();

$stm = $db->prepare("SELECT COUNT(1) FROM usuario WHERE activacion_key=:activacion_key");
$stm->bindParam(":activacion_key", $activation_key);
$stm->execute();
$total = $stm->fetchColumn();

if ($total == 1) {
    //echo "<br>hay";
    try {
        $stm = $db->prepare("UPDATE usuario SET validated=1 WHERE activacion_key=:activacion_key");
        $stm->bindParam(":activacion_key", $activation_key);
        $stm->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    echo "<br>¡Bienvenido!";
} else {
    echo "<br>no hay";
}