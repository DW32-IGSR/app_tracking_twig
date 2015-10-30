<?php
include("posicion.class.php");
include("usuario.class.php");
session_start();
class Model {
    public $posicion;
    public $datos;
    public $latitud;
    public $longitud;
    
    public $nombre;
    public $pass;
    public $usuario;
    
    public function __construct() {
        //$this->string = "MVC + PHP = Awesome!";
        //$this->posicion=$this->buscar_posiciones();
    }
    
    public function insertarPosicion($id_usuario, $latitud, $longitud, $titulo) {
        echo "insercion en marcha";
        require_once("conexion.class.php");
        $db = Conexion::conectar();
    	//$stmt = $db->prepare('INSERT INTO posicion (latitud, longitud, hora, id_usuario) VALUES (:latitud,:longitud,:hora,:id_usuario)');
    	$stmt = $db->prepare('INSERT INTO posicion (latitud, longitud, hora, id_usuario, titulo) VALUES (:latitud,:longitud,:hora,:id_usuario, :titulo)');
    	//INSERT INTO `posicion`(`latitud`, `longitud`, `id_usuario`, `hora`) VALUES (5465464,4564564645,1, CURRENT_TIMESTAMP)
    	$stmt->bindParam(':latitud', $latitud);
    	$stmt->bindParam(':longitud', $longitud); 
    	$stmt->bindParam(':hora', date("Y-m-d H:i:s"));
    	$stmt->bindParam(':id_usuario', $id_usuario);
    	$stmt->bindParam(':titulo', $titulo);
        $stmt->execute();
        $lastid= $db -> lastInsertId();
    }
    
    public function borrarPosicion($id_usuario, $id_posicion) {
        if ($_POST['borrar']){
            require_once("conexion.class.php");
            $db = Conexion::conectar();
        	$stmt = $db->prepare('DELETE FROM posicion WHERE id_posicion=:id_posicion AND id_usuario=:id_usuario');
        	$stmt->bindParam(':id_posicion', $id_posicion, PDO::PARAM_INT);
        	$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    
    public function editarPosicion($id_posicion, $latitud, $longitud, $titulo) {
        if ($_POST['editar']){
            require_once("conexion.class.php");
            $db = Conexion::conectar();
            //echo "</br>$id_posicion, $latitud, $longitud, $titulo";
            try {	
            	$stmt = $db->prepare('UPDATE posicion SET titulo=:titulo, latitud=:latitud, longitud=:longitud WHERE id_posicion=:id_posicion');
            	//$stmt = $db->prepare('UPDATE posicion SET titulo=?, latitud=?, longitud=? WHERE id_posicion=?');
            	//$stmt->execute(array($titulo,$latitud,$longitud,$id_posicion));
            	$stmt->bindParam(':titulo', $titulo);
            	$stmt->bindParam(':latitud', $latitud);
            	$stmt->bindParam(':longitud', $longitud);
            	$stmt->bindParam(':id_posicion', $id_posicion);
            	//$stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->execute();
                //var_dump($stmt);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }	
        }
    }
    
    public function buscar_posiciones(){
        require_once("conexion.class.php");
        $db = Conexion::conectar();
    	$stmt = $db->prepare("SELECT id_posicion, latitud, longitud, hora, titulo FROM posicion WHERE id_usuario=:id_usuario");
        //$stmt->bindParam(":id_usuario", $_SESSION['id_usuario'], PDO::PARAM_INT);
        $idusuario=1;
        $stmt->bindParam(":id_usuario", $idusuario, PDO::PARAM_INT);
        $stmt->execute();
        //$respuesta="\n";
        //$_SESSION['id_usuario']=1;
        $marcadores = array();
        foreach ($stmt->fetchAll() as $row) {
            array_push($marcadores, new Posicion($row['id_posicion'],$row['latitud'],$row['longitud'],$row['hora'],$_SESSION['id_usuario'],$row['titulo']));
        }
        return $marcadores;
    }
    
    public function buscarUsuario($usuario, $pass, $latitud, $longitud) {
        require_once("conexion.class.php");
        $db = Conexion::conectar();
    	$stmt = $db->prepare("SELECT * FROM usuario WHERE usuario=:usuario and pass=:pass");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
        $stmt->execute();
        $respuesta="";
        foreach ($stmt->fetchAll() as $row) {
            //var_dump($row);
            $usuario=new Usuario($row['id_usuario'],$row["usuario"],$row["pass"]);
            echo "<p>".$usuario->mostrar()."</p>";
            //session_start();
            $_SESSION['id_usuario']=$row["id_usuario"];
            
            $titulo=date("Y-m-d H:i:s");
            Model::insertarPosicion($row['id_usuario'], $latitud, $longitud, $titulo);
        }
    }
    public function registrarUsuario($usuario, $pass){
        require_once("conexion.class.php");
        $db = Conexion::conectar();
        $stmt = $db->prepare("INSERT INTO usuario (usuario, pass) VALUES (:usuario, :pass)");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
        $stmt->execute();
    }
}