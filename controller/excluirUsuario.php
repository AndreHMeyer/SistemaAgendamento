<?php


header('Content-Type: application/json');

$idUsuario = $_REQUEST['id_usuario'];

$sucesso = true;

if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Usuário excluído com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao excluir usuario.']);
}

echo $response;
