<?php


use Database\RepositorioUsuario;
require_once("..\bancoDeDados\RepositorioUsuario.php");

header('Content-Type: application/json');

$idUsuario = $_REQUEST['id_usuario'];

$repo = new RepositorioUsuario();



$usuarioDelete = $repo->obterUsuarioById($idUsuario);

$sucesso = $repo->deleteUsuario($usuarioDelete);


if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Usuario excluido com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao excluir usuario.']);
}

echo $response;
