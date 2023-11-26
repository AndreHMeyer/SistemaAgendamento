<?php

use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");


$nome = $_REQUEST["nome"];
$cpf = $_REQUEST["cpf"];
$dataNascimento = $_REQUEST['data_nascimento'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST["email"];
$endereco = $_REQUEST["endereco"];


//Instancia o repositório
$repo = new RepositorioPessoas();

////Busca se já existe uma pessoa com esse CPF
//$pessoa = $repo->obterPessoaByCpf($cpf);

 //Se não existir pessoa, faz um novo cadastro

$pessoa = new Pessoa(null, $nome, $email, $cpf, $dataNascimento, $telefone, $endereco, null, null, null, null);

    // Insere a pessoa no banco de dados
$sucesso = $repo->inserirPessoa($pessoa);

if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Paciente cadastrado com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao cadastrar paciente.']);
}

echo $response;


?>