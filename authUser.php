<?php

require_once 'vendor/autoload.php';
require_once 'Utilidades.php';
require_once 'Usuario.php';

if(isset($_POST["session_token"])){
	session_start();
	echo json_encode(["session_token"=> $_SESSION["session_token"],"id_token"=> $_SESSION["id_token"]]);
}else{
	if(isset($_POST["id_token"])){
		
		$usuario = Usuario::getInstance();
		$usuario->session_token = randomString();
		$usuario->id_token = $_POST["id_token"];
		echo json_encode(["session_token"=>$usuario->session_token,"id_token"=>$usuario->id_token]);
	}else{
		echo json_encode([["respuesta"=>"sin id_token"]]);
	}
}

?>