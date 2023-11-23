<?php

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$crm = $_POST['crm'];
$conselho = $_POST['conselho'];
$crm_estado = $_POST['crm_estado'];
$endereco = $_POST['endereco'];

$erro = true;

if ($erro) {
    $response = array("success" => false, "message" => "Ocorreu um erro durante o processamento.");
} else {
    $response = array("success" => false, "message" => "Operação concluída com sucesso.");
}


echo json_encode($response);
