<?php
session_start();
//include("../model/model.php");
//provisional
//$_SESSION['id_usuario']=1;
//echo "pruebas";
    
if (isset($_POST['crearPosicion'])){
    include_once("../model/model.php");
    session_start();
    //provisional
    $id_usuario = $_SESSION['id_usuario'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $titulo = $_POST['titulo'];
    Model::insertarPosicion($id_usuario,$latitud,$longitud, $titulo);
    header('Location: ../');
}

if (isset($_POST['borrar'])){
    include_once("../model/model.php");
    $id_usuario = $_SESSION['id_usuario'];
    $id_posicion = $_POST['id_posicion'];
    Model::borrarPosicion($id_usuario, $id_posicion);
    header('Location: ../');
}
if(isset($_POST['editar'])){
    include_once("../model/model.php");
    $titulo = $_POST['titulo'];
    $id_posicion = $_POST['id_posicion'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    //echo "$id_posicion, $latitud, $longitud, $titulo";
    Model::editarPosicion($id_posicion, $latitud, $longitud, $titulo); 
    header('Location: ../');
}

if (isset($_POST['login'])){
    include_once("../model/model.php");
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $lat = $_GET['lat'];
    $long = $_GET['long'];
    //configurando para insertar titulo
    //$titulo = $_GET['titulo'];
    Model::buscarUsuario($usuario, $pass, $lat, $long);
    header('Location: ../');
}

if (isset($_POST['register'])){
    include_once("../model/model.php");
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    if($pass == $pass2){
        Model::registrarUsuario($usuario, $pass);
        header('Location: ../');
        //echo "registro completado";
    }
}

/*function destructorSesion(){
    //vaciar la sesion
    echo "prueba";
    session_start();
    session_destroy();
    //header("location:index.php");
}*/