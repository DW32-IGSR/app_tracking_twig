<?php

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

function generate_random_key() {

      $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
      $new_key = "";
      for ($i = 0; $i < 32; $i++) {
          $new_key .= $chars[rand(0,35)];
      }
      return $new_key;
}

$random_key = generate_random_key();
$validated = 0;

# Instantiate the client.
$mgClient = new Mailgun('key-116da3f3cd011ad01d454a632a599587');
$domain = "sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org";

$nombre = $_POST[''];
$email = $_POST[''];

//Model::registrarUsuario($usuario, $pass, $email, $random_key, $validated);

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
array('from'    => 'Todo-List IGSR <postmaster@sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org>',
    //'to'      => 'IGSR <dw32igsr@gmail.com>',
    'to'      => $nombre . ' ' .$email,
    'subject' => 'Registro en Todo-List',
    //'text'    => 'Mensaje desde Cloud9'));
    'text'    => "Hola $nombre!
                Gracias por registrarse en nuestro sitio.
                Su cuenta ha sido creada, y debe ser activada antes de poder ser utilizada.
                Para activar la cuenta, haga click en el siguiente enlace o copielo en la
                barra de direcciones del navegador:
                http://localhost/email/activate.php?activation=".$random_key.""));