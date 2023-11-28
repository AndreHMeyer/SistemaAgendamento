<?php

namespace Database;

use Agenda\Agendamento;

require_once(__DIR__ . "..\..\model\agenda\Agendamento.php");
require_once(__DIR__ . ".\ConexaoDB.php");

class RepositorioConsultas
{
    private $conexao;

    public function __construct()
    {
        $conexao = new ConexaoDB();
        $this->conexao = $conexao->criarConexao();
    }

    public function inserirAgendamento(Agendamento $agendamento): bool
    {
        $conexao = $this->conexao;

        $tipoConsulta = $agendamento->getTipoConsulta();
        $idPessoa = $agendamento->getPaciente();
        $idProfissional = $agendamento->getProfissional();
        $dataInicio = $agendamento->getDtInicio();
        $dataFim = $agendamento->getDtFim();



        $sqlInsert = "insert into consulta (observacao, idPessoa, idProfissional, dataInicio, dataFim) values (?,?,?,?,?)";

        $stmt = $conexao->prepare($sqlInsert);
        $stmt->bind_param('sssss', $tipoConsulta, $idPessoa, $idProfissional, $dataInicio, $dataFim);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function obterProximoAgendamento()
    {

    }
}