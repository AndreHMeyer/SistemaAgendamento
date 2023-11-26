<?php

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$status = true;

if ($status) {
    $response = array("success" => true, "message" => "Operação concluída com sucesso.");
} else {
    $response = array("success" => false, "message" => "Ocorreu um erro durante o processamento.");
}

echo json_encode($response);
