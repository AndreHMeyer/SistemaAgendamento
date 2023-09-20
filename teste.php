<?php

use Database\ConexaoDB;
use Database\RepositorioPessoas;
use Database\RepositorioUsuario;
use Pessoa\Pessoa;


//include(".\bancoDeDados\ConexaoDB.php");
require_once(".\bancoDeDados\RepositorioPessoas.php");
require_once (".\model\usuarios\Login.php");
require_once (".\bancoDeDados\RepositorioUsuario.php");

$repo = new RepositorioUsuario();

$usuario = $repo->obterTodosUsuarios();

//var_dump($usuario);

//$repo = new RepositorioPessoas();
//
//$pessoa = $repo->obterTodasPessoas();
//
//var_dump($pessoa);
//$login = new Login('joao@teste.com', 'hashed_password1');
//
//$login->autenticar();
//
//$response = array("result" => "success");
////var_dump($response); exit();
//return json_encode($response);


