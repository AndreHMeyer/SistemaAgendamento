<?php

$nome = $_REQUEST["nome"];
$cpf = $_REQUEST["cpf"];
$dataNascimento = $_REQUEST['data_nascimento'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST["email"];
$endereco = $_REQUEST["endereco"];

$sucesso = true;


if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Paciente cadastrado com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao cadastrar paciente.']);
}

echo $response;


?>