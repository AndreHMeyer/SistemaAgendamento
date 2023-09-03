<?php

use Database\ConexaoDB;
use Database\RepositorioPessoas;
use Pessoa\Pessoa;

//include(".\bancoDeDados\ConexaoDB.php");
require_once(".\bancoDeDados\RepositorioPessoas.php");

$conexao = new ConexaoDB();
$conexao = $conexao->criarConexao();

$repo = new RepositorioPessoas();

$pessoa = $repo->obterPessoaByCpf('123456');
if ($pessoa) {
    $repo->deletePessoa($pessoa);
}

