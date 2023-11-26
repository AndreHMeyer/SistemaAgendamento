<?php

use Database\RepositorioUsuario;
use Usuario\Usuario;

require_once("..\bancoDeDados\RepositorioUsuario.php");

$id = $_POST['id'];
$nome = $_POST['nomeUsuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];

$repoUsuarios = new RepositorioUsuario();

$usuario = new Usuario($id, $nome, $senha, $email);

$sucesso = $repoUsuarios->updateUsuario($usuario);


if ($sucesso) {
    $response = array("success" => true, "message" => "Operação concluída com sucesso.");
} else {
    $response = array("success" => false, "message" => "Ocorreu um erro durante o processamento.");
}

echo json_encode($response);
