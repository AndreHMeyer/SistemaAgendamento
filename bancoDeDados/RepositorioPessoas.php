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

    public function obterTodasPessoas()
    {
        $conexao = $this->conexao;

        $sql = "SELECT * FROM PESSOA order by id asc";
        $result = mysqli_query($conexao, $sql);

        if ($result->num_rows > 0) {


            $pessoa = [];

            while ($row = $result->fetch_assoc()) {

                $pessoa[] = new Pessoa(
                    $row['id'],
                    $row['nome'],
                    $row['email'],
                    $row['cpf'],
                    $row['dataNascimento'],
                    $row['telefone'],
                    $row['endereco'],
                    $row['crm'],
                    $row['especialidade']

                );
            }

            return $pessoa;
        }
        return false;

    }

    public function obterPessoaPorId($id)
    {
        $conexao = $this->conexao;

        $idParam = mysqli_real_escape_string($conexao, $id);

        $sql = "SELECT * FROM PESSOA where id = '$idParam'  order by id asc";
        $result = mysqli_query($conexao, $sql);

        if ($result->num_rows > 0) {


            $pessoa = [];

            while ($row = $result->fetch_assoc()) {

                $pessoa = new Pessoa(
                    $row['id'],
                    $row['nome'],
                    $row['email'],
                    $row['cpf'],
                    $row['dataNascimento'],
                    $row['telefone'],
                    $row['endereco'],
                    $row['numero_conselho'],
                    $row['tipo_conselho'],
                    $row['estado_conselho'],
                    $row['especialidade']

                );
            }

            return $pessoa;
        }
        return false;

    }

    public function obterTodosProfissionais()
    {
        $conexao = $this->conexao;

        $sql = "SELECT * FROM PESSOA where ESPECIALIDADE is not null order by id asc";
        $result = mysqli_query($conexao, $sql);

        if ($result->num_rows > 0) {


            $pessoa = [];

            while ($row = $result->fetch_assoc()) {

                $pessoa[] = new Pessoa(
                    $row['id'],
                    $row['nome'],
                    $row['email'],
                    $row['cpf'],
                    $row['dataNascimento'],
                    $row['telefone'],
                    $row['endereco'],
                    $row['numero_conselho'],
                    $row['tipo_conselho'],
                    $row['estado_conselho'],
                    $row['especialidade']

                );
            }

            return $pessoa;
        }
        return false;

    }

    public function obterProfissionalPorId($id)
    {
        $conexao = $this->conexao;

        $idParam = mysqli_real_escape_string($conexao, $id);

        $sql = "SELECT * FROM PESSOA where ESPECIALIDADE is not null and id = '$idParam'  order by id asc";
        $result = mysqli_query($conexao, $sql);

        if ($result->num_rows > 0) {


            $pessoa = [];

            while ($row = $result->fetch_assoc()) {

                $pessoa = new Pessoa(
                    $row['id'],
                    $row['nome'],
                    $row['email'],
                    $row['cpf'],
                    $row['dataNascimento'],
                    $row['telefone'],
                    $row['endereco'],
                    $row['numero_conselho'],
                    $row['tipo_conselho'],
                    $row['estado_conselho'],
                    $row['especialidade']

                );
            }

            return $pessoa;
        }
        return false;

    }

    public function inserirPessoa(Pessoa $pessoa)
    {
        $conexao = $this->conexao;

        $nome = $pessoa->getNome();
        $email = $pessoa->getEmail();
        $dataNascimento = $pessoa->getDataNascimento();
        $cpf = $pessoa->getCpf();
        $telefone = $pessoa->getTelefone();
        $endereco = $pessoa->getEndereco();
        $numeroConselho = $pessoa->getNumeroConselho();
        $tipoConselho = $pessoa->getTipoConselho();
        $estadoConselho = $pessoa->getEstadoConselho();
        $especialidade = '';

        $insertSQL = "INSERT INTO PESSOA (nome, email, cpf, dataNascimento, telefone, endereco, numero_conselho, especialidade, tipo_conselho, estado_conselho) 
                                values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($insertSQL);
        $stmt->bind_param('ssssssssss', $nome, $email, $cpf, $dataNascimento, $telefone, $endereco, $numeroConselho, $especialidade, $tipoConselho, $estadoConselho);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function updatePessoa(Pessoa $pessoa)
    {
        $conexao = $this->conexao;

        $id = mysqli_real_escape_string($conexao, $pessoa->getId());
        $nome = mysqli_real_escape_string($conexao, $pessoa->getNome());
        $cpf = mysqli_real_escape_string($conexao, $pessoa->getCpf());
        $email = mysqli_real_escape_string($conexao, $pessoa->getEmail());
        $endereco = mysqli_real_escape_string($conexao, $pessoa->getEndereco());
        $telefone = mysqli_real_escape_string($conexao, $pessoa->getTelefone());
        $dataNascimento = mysqli_real_escape_string($conexao, $pessoa->getDataNascimento());
        $numeroConselho = mysqli_real_escape_string($conexao, $pessoa->getNumeroConselho());
        $tipoConselho = mysqli_real_escape_string($conexao, $pessoa->getTipoConselho());
        $estadoConselho = mysqli_real_escape_string($conexao, $pessoa->getEstadoConselho());





        $selectSQL = "SELECT COUNT(1) AS TOTAL FROM PESSOA WHERE id = '$id'";
        $result = mysqli_query($conexao, $selectSQL);
        $row = mysqli_fetch_assoc($result);

        if($row['TOTAL'] >= 1) { //Se encontrou uma pessoa com esse CPF
            $updateSQL = "UPDATE PESSOA SET 
                  nome = ?,
                  cpf = ?,
                  email = ?,
                  dataNascimento = ?,
                  telefone = ?,
                  endereco = ?,
                  numero_conselho = ?,
                  tipo_conselho = ?,
                  estado_conselho = ?
                  WHERE ID = ?";

            $stmt = $conexao->prepare($updateSQL);
            $stmt->bind_param('ssssssssss', $nome, $cpf,$email, $dataNascimento, $telefone, $endereco, $numeroConselho, $tipoConselho, $estadoConselho, $id);

            if ($stmt->execute()) {
                return true;
            } else {
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