<?php

//Esse arquivo é chamado pelo viewCadastrarPessoa.php. Responsável por inserir pessoas no banco de dados


use Database\ConexaoDB;
use Database\RepositorioPessoas;
use Pessoa\Pessoa;

//include("..\bancoDeDados\ConexaoDB.php");
//include(__DIR__ . "\..\bancoDeDados\ConexaoDB.php");
require_once("..\model\pessoas\Pessoa.php");
require_once("..\bancoDeDados\RepositorioPessoas.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") { //Caso o formulário tenha sido enviado com POST

    //Obtem os valores dos campos do formulário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $dataNascimento = $_POST["dataNascimento"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    //Instancia o repositório
    $repo = new RepositorioPessoas();

    //Busca se já existe uma pessoa com esse CPF
    $pessoa = $repo->obterPessoaByCpf($cpf);

    if ($pessoa) { //Caso exista pessoa com CPF, atualiza o cadastro
        $pessoa->setNome($nome);
        $pessoa->setDataNascimento($dataNascimento);
        $pessoa->setEmail($email);
        $pessoa->setTelefone($telefone);
        $pessoa->setEndereco($endereco);

        $repo->updatePessoa($pessoa);

    } else { //Se não existir pessoa, faz um novo cadastro

        $pessoa = new Pessoa(null, $nome, $email, $cpf, $dataNascimento, $telefone, $endereco);

        // Insere a pessoa no banco de dados
        $sucesso = $repo->inserirPessoa($pessoa);

        if ($sucesso) {
            echo "Pessoa cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar pessoa.";
        }
    }


}
?>