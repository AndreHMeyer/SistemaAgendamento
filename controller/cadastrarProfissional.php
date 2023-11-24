<?php

use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");

//header('Content-Type: application/json');

$nome = $_REQUEST['nome'];
$cpf = $_REQUEST['cpf'];
$data_nascimento = $_REQUEST['data_nascimento'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST['email'];
$numeroConselho = $_REQUEST['crm'];
$tipoConselho = $_REQUEST['conselho'];
$estadoConselho = $_REQUEST['crm_estado'];
$endereco = $_REQUEST['endereco'];
//$especialidade = $_REQUEST['especialidade']; precisa do campo no formulário


$repoProfissionais = new RepositorioPessoas();

$profissional = new Pessoa(null, $nome, $email, $cpf, $data_nascimento, $telefone, $endereco, $numeroConselho, $tipoConselho, $estadoConselho, null);

$sucesso = $repoProfissionais->inserirPessoa($profissional);


if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Profissional cadastrado com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao cadastrar profissional.']);
}

echo $response;
?>