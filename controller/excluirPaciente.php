<?php
use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");

header('Content-Type: application/json');

$idPaciente = $_REQUEST['id_paciente'];

$repo = new RepositorioPessoas();

$pessoaDelete = $repo->obterPessoaPorId($idPaciente);

$sucesso = $repo->deletePessoa($pessoaDelete);

if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Paciente excluído com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao excluir paciente.']);
}

echo $response;