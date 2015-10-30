<?php
session_start();
//provisional
//$_SESSION['id_usuario']=1;
    
class Controller {
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
    }

    public function mostrar_posiciones() {
    	$this->model->buscar_posiciones();
    }
    
    public function posicionar() {
        echo "pruebas insercion1";
        if ($_POST['crearPosicion']){
            echo "pruebas insercion2";
            session_start();
            //provisional
            //$_SESSION['id_usuario']=1;
            //provisional
            $id_usuario = $_SESSION['id_usuario'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $titulo = $_POST['titulo'];
            //$this->model->insertarPosicion($id_usuario,$latitud,$longitud, $titulo);
            $this->model->insertarPosicion($id_usuario,$latitud,$longitud, $titulo);
            echo "insercion completada fin";
            //header('Location: ../index.php');
        }
    }
    
    public function login() {
        if ($_POST['login']){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $lat = $_GET['lat'];
            $long = $_GET['long'];
            //configurando para insertar titulo
            //$titulo = $_GET['titulo'];
            Model::buscarUsuario($usuario, $pass, $lat, $long/*, $titulo*/);
            header('Location: ../index.php');
        }
    }
    
    public function register(){
        if ($_POST['register']){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            if($pass == $pass2){
                $this->model->registrarUsuario($usuario, $pass);
            }
        }
    }
    
    public function destructorSesion(){
        //vaciar la sesion
        session_start();
        session_destroy();
        header("location:index.php");
    }
    
    public function modificarPosicion() {
        if ($_POST['borrar']){
            $id_usuario = $_SESSION['id_usuario'];
            $id_posicion = $_POST['id_posicion'];
            $this->model->borrarPosicion($id_usuario, $id_posicion);
        }else if($_POST['editar']){
            $titulo = $_POST['titulo'];
            $id_posicion = $_POST['id_posicion'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            //echo "$id_posicion, $latitud, $longitud, $titulo";
            $this->model->editarPosicion($id_posicion, $latitud, $longitud, $titulo); 
        }
    }
}


//solucion para formulario en index.html
if (isset($_POST['crearPosicion'])){
    include_once("../model/model.php");
    session_start();
    //provisional
    $id_usuario = $_SESSION['id_usuario'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $titulo = $_POST['titulo'];
    Model::insertarPosicion($id_usuario,$latitud,$longitud, $titulo);
    header('Location: ../index.php');
}

if (isset($_POST['borrar'])){
    include_once("../model/model.php");
    $id_usuario = $_SESSION['id_usuario'];
    $id_posicion = $_POST['id_posicion'];
    Model::borrarPosicion($id_usuario, $id_posicion);
    header('Location: ../index.php');
}
if(isset($_POST['editar'])){
    include_once("../model/model.php");
    $titulo = $_POST['titulo'];
    $id_posicion = $_POST['id_posicion'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    //echo "$id_posicion, $latitud, $longitud, $titulo";
    Model::editarPosicion($id_posicion, $latitud, $longitud, $titulo); 
    header('Location: ../index.php');
}

if (isset($_POST['login'])){
    include_once("../model/model.php");
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $lat = $_GET['lat'];
    $long = $_GET['long'];
    //configurando para insertar titulo
    //$titulo = $_GET['titulo'];
    Model::buscarUsuario($usuario, $pass, $lat, $long/*, $titulo*/);
    header('Location: ../index.php');
}