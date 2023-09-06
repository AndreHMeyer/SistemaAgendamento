<?php

use Database\ConexaoDB;
use Database\RepositorioPessoas;
use Pessoa\Pessoa;


//include(".\bancoDeDados\ConexaoDB.php");
require_once(".\bancoDeDados\RepositorioPessoas.php");
require_once (".\model\usuarios\Login.php");

$login = new Login('joao@teste.com', 'hashed_password1');

$login->autenticar();

$response = array("result" => "success");
//var_dump($response); exit();
return json_encode($response);


