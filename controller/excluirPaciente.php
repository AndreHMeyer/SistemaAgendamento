<?php

header('Content-Type: application/json');

$idPaciente = $_REQUEST['id_paciente'];

$sucesso = true;

if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Paciente excluído com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao excluir paciente.']);
}

echo $response;