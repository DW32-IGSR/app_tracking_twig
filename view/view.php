<?php
class View {
    private $model;
    //private $usuario;    
    private $controller;
	
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
	

    /*public function login() {
        $respuesta = "
<script type='text/javascript'>
    if (typeof navigator.geolocation == 'object'){
        navigator.geolocation.getCurrentPosition(mostrar_ubicacion);
    }
    function mostrar_ubicacion(p){
        var latti = p.coords.latitude;
        var longi = p.coords.longitude;
        //var titulo = 'prueba32';
        //alert(latti+' , '+longi);
        //document.getElementById('formulario').action='index.php?action=login&titulo='+titulo+'&lat='+latti+'&long='+longi;
        document.getElementById('formulario').action='index.php?action=login&lat='+latti+'&long='+longi;
    }
</script>
        <!--<form action='index.php?action=login' method='POST' name='formulario_login'>-->
        <form id='formulario' action='' method='POST' name='formulario_login'>
        <table>
        <tr>
        <td>Usuario: </td><td><input type='text' name='usuario'><td>
        </tr>
        <tr>
        <td>Contraseña: </td><td><input type='password' name='pass'></td> 
        </tr>
        <tr>
        <td><input type='submit' name='login' value='Entrar'></td>
        </tr>
        </table>
        </form>";
        return $respuesta;
    }*/
    
    /*public function register() {
        $respuesta = "<form action='index.php?action=register' method='POST' name='formulario_register'>
        <table bgcolor='lightblue'>
        <tr>
            <td>Usuario: </td><td><input type='text' name='usuario'></td>
        </tr>
        <tr>
            <td>Contraseña: </td><td><input type='password' name='pass'><td>
        </tr>
        <tr>
            <td>Repita la contraseña </td><td><input type='password' name='pass2'><td>
        </tr>
        <tr>
            <td><input type='submit' name='register' value='Registrar'></td>
        </tr>
        </table>
        </form>";
        return $respuesta;
    }*/
    
    
    public function enviarPosicion(){
       $script='<script type="text/javascript">
        if (typeof navigator.geolocation == "object"){
            navigator.geolocation.getCurrentPosition(mostrar_ubicacion);
        }
        function mostrar_ubicacion(p){
           // document.getElementById("TE").innerHTML = ("posición: "+p.coords.latitude+","+p.coords.longitude );
            var latti = p.coords.latitude;
            var longgii = p.coords.longitude;
            document.getElementById("latitud").value = latti;
            document.getElementById("longitud").value = longgii;
        }
        </script>';
        return $script;
    }  
}