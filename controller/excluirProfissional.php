<?php
use Database\RepositorioPessoas;
use Pessoa\Pessoa;

require_once("..\bancoDeDados\RepositorioPessoas.php");

header('Content-Type: application/json');

$idProfissional = $_REQUEST['id_profissional'];

$repo = new RepositorioPessoas();

$pessoaDelete = $repo->obterPessoaPorId($idProfissional);

$sucesso = $repo->deletePessoa($pessoaDelete);

if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Profissional excluído com sucesso!']);
} else {
    $response =  json_encode(['success' => false, 'message' => 'Erro ao excluir profissional.']);
}

echo $response;