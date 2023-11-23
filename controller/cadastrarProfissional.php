<?php

use Database\RepositorioPessoas;

header('Content-Type: application/json');

$nome = $_REQUEST['nome'];
$cpf = $_REQUEST['cpf'];
$data_nascimento = $_REQUEST['data_nascimento'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST['email'];
$crm = $_REQUEST['crm'];
$conselho = $_REQUEST['conselho'];
$crm_estado = $_REQUEST['crm_estado'];
$endereco = $_REQUEST['endereco'];


$repoProfissionais = new RepositorioPessoas();

$profissional = new Pessoa(null, $nome, $email, $cpf, $data_nascimento, $telefone, $endereco, $crm, null);

$sucesso = $repoProfissionais->inserirPessoa($profissional);


if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Profissional cadastrado com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao cadastrar profissional.']);
}

echo $response;
?>