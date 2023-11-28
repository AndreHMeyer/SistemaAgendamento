<?php

use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");


$nome = isset($_REQUEST["nome"]) ? $_REQUEST["nome"] : null;
$cpf = isset($_REQUEST["cpf"]) ? $_REQUEST["cpf"] : null;
$dataNascimento = isset($_REQUEST['data_nascimento']) ? $_REQUEST['data_nascimento'] : null;
$telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone'] : null;
$email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
$endereco = isset($_REQUEST["endereco"]) ? $_REQUEST["endereco"] : null;


//Instancia o repositório
$repo = new RepositorioPessoas();

////Busca se já existe uma pessoa com esse CPF
//$pessoa = $repo->obterPessoaByCpf($cpf);

 //Se não existir pessoa, faz um novo cadastro

$pessoa = new Pessoa(null, $nome, $email, $cpf, $dataNascimento, $telefone, $endereco, null, null, null, null);

    // Insere a pessoa no banco de dados
$sucesso = $repo->inserirPessoa($pessoa);

unset($_REQUEST["nome"]);
unset($_REQUEST["cpf"]);
unset($_REQUEST['data_nascimento']);
unset($_REQUEST['telefone']);
unset($_REQUEST['telefone']);
unset($_REQUEST["endereco"]);



if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Paciente cadastrado com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao cadastrar paciente.']);
}

echo $response;


?>