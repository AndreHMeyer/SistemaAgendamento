<?php

use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");

$id_paciente = $_REQUEST["id_paciente"];
$nome = $_REQUEST["nome"];
$cpf = $_REQUEST["cpf"];
$dataNascimento = $_REQUEST['data_nascimento'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST["email"];
$endereco = $_REQUEST["endereco"];

$repo = new RepositorioPessoas();
$pessoaUpdate = new Pessoa($id_paciente, $nome, $email, $cpf, $dataNascimento, $telefone, $endereco, null, null, null, null);

$status = $repo->updatePessoa($pessoaUpdate);



if ($status) {
    $response = array("success" => true, "message" => "Operação concluída com sucesso.");
} else {
    $response = array("success" => false, "message" => "Ocorreu um erro durante o processamento.");
}

echo json_encode($response);
