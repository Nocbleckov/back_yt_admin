<?php

require_once 'vendor/autoload.php';
require_once 'Utilidades.php';
require_once 'Usuario.php';

if(isset($_POST["session_token"])){

}else{
	if(isset($_POST["id_token"])){
		
		$usuario = Usuario::getInstance($_POST["id_token"]);
		$usuario->session_token = randomString();
		echo json_encode($usuario->session_token);

	}else{
		echo json_encode([["respuesta"=>"sin id_token"]]);
	}
}

?>