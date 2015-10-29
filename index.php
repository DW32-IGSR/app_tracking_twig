<?php
// twig template example
require_once 'vendor/autoload.php';
include_once("model/model.php");
include_once("controller/controller.php");
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader);

$marcadores=Model::buscar_posiciones();
//var_dump($marcadores);
echo $twig->render('index.html', 
					array(
						'markers' => $marcadores));
?>