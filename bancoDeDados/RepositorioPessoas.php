<?php

namespace Database;

use Pessoa\Pessoa;

require_once(__DIR__ . "..\..\model\pessoas\Pessoa.php");

//Essa classe é utilizada para obter dados do banco.

class RepositorioPessoas
{
    private $conexao;

    public function __construct()
    {
        $conexao = new ConexaoDB();
        $this->conexao = $conexao->criarConexao();
    }

    public function obterPessoaByCpf($cpf)
    {
        $conexao = $this->conexao;

        $cpfParam = mysqli_real_escape_string($conexao, $cpf);

        $sql = "SELECT * FROM PESSOA WHERE CPF = '$cpfParam'";

        $result = mysqli_query($conexao, $sql);
//        var_dump($result);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);

            $pessoa = new Pessoa(
                $row['id'],
                $row['nome'],
                $row['email'],
                $row['cpf'],
                $row['dataNascimento'],
                $row['telefone'],
                $row['endereco']
            );

            return $pessoa;

        } else {
            echo 'Pessoa não encontrada';
            return false; //Necessário lançar exceção
        }




    }

    public function inserirPessoa(Pessoa $pessoa)
    {
        $conexao = $this->conexao;

        $nome = $pessoa->getNome();
        $email = $pessoa->getEmail();
        $dataNascimento = $pessoa->getDataNascimento();
        $cpf = $pessoa->getCpf();

        $insertSQL = "INSERT INTO PESSOA (nome, email, cpf, dataNascimento) values (?, ?, ?, ?)";
        $stmt = $conexao->prepare($insertSQL);
        $stmt->bind_param('ssss', $nome, $email, $cpf, $dataNascimento);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function updatePessoa(Pessoa $pessoa)
    {
        $conexao = $this->conexao;

        $nome = mysqli_real_escape_string($conexao, $pessoa->getNome());
        $cpf = mysqli_real_escape_string($conexao, $pessoa->getCpf());
        $email = mysqli_real_escape_string($conexao, $pessoa->getEmail());
        $endereco = mysqli_real_escape_string($conexao, $pessoa->getEndereco());
        $telefone = mysqli_real_escape_string($conexao, $pessoa->getTelefone());
        $dataNascimento = mysqli_real_escape_string($conexao, $pessoa->getDataNascimento());



        $selectSQL = "SELECT COUNT(1) AS TOTAL FROM PESSOA WHERE CPF = '$cpf'";
        $result = mysqli_query($conexao, $selectSQL);
        $row = mysqli_fetch_assoc($result);

        if($row['TOTAL'] >= 1) { //Se encontrou uma pessoa com esse CPF
            $updateSQL = "UPDATE PESSOA SET 
                  nome = ?,
                  email = ?,
                  dataNascimento = ?,
                  telefone = ?,
                  endereco = ?
                  WHERE CPF = ?";

            $stmt = $conexao->prepare($updateSQL);
            $stmt->bind_param('ssssss', $nome, $email, $dataNascimento, $telefone, $endereco, $cpf);

            if ($stmt->execute()) {
                echo 'Pessoa atualizada com sucesso' . PHP_EOL;
                return true;
            } else {
                echo 'Houve um erro ao atualizar o cadastro da pessoa' .PHP_EOL;
                return false;
            }
        }

    }

    public function deletePessoa(Pessoa $pessoa)
    {
        $conexao = $this->conexao;

        $cpf = $pessoa->getCpf();

        $deleteSQL = "DELETE FROM PESSOA WHERE CPF = ?";
        $stmt = $conexao->prepare($deleteSQL);
        $stmt->bind_param('s', $cpf);

        if ($stmt->execute()) {
            echo 'Pessoa excluída com sucess.';
            return true;
        } else {
            echo 'Houve um erro ao excluir a pessoa.';
            return false;
        }


    }
}