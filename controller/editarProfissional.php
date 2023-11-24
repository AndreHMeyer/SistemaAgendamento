<?php


use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$numeroConselho = $_POST['crm'];
$tipoConselho = $_POST['conselho'];
$estadoConselho = $_POST['crm_estado'];
$endereco = $_POST['endereco'];
//$especialidade = $_POST['especialidade']; PRECISA ADD NO FORM DE EDIÇÃO DE PROFISSIONAL


$repo = new RepositorioPessoas();
$pessoaUpdate = new Pessoa($id, $nome, $email, $cpf, $data_nascimento, $telefone, $endereco, $numeroConselho, $tipoConselho, $estadoConselho, null);

$status = $repo->updatePessoa($pessoaUpdate);



if ($status) {
    $response = array("success" => true, "message" => "Operação concluída com sucesso.");
} else {
    $response = array("success" => false, "message" => "Ocorreu um erro durante o processamento.");
}


echo json_encode($response);
