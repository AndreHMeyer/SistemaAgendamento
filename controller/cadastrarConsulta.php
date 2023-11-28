<?php


use Database\RepositorioConsultas;
use Agenda\Agendamento;

require_once("..\bancoDeDados\RepositorioConsultas.php");

$observacao = isset($_REQUEST['tipoConsulta']) ? $_REQUEST['tipoConsulta'] : "";
$idPessoa = isset($_REQUEST['pacienteConsulta']) ? $_REQUEST['pacienteConsulta'] : "";
$idProfissional = isset($_REQUEST['profissionalConsulta']) ? $_REQUEST['profissionalConsulta'] : "";
$dataInicio = isset($_REQUEST['dataInicioConsulta']) ? $_REQUEST['dataInicioConsulta'] : "";
$dataFim = isset($_REQUEST['dataFimConsulta']) ? $_REQUEST['dataFimConsulta'] : "";

$dataInicio = str_replace("T", " ", $dataInicio);
$dataInicio .= ":00";
$dataFim = str_replace("T", " ", $dataFim);
$dataFim .= ":00";

$agendamento = new Agendamento($observacao, $dataInicio, $dataFim, $idPessoa, $idProfissional);

$repo = new RepositorioConsultas();

$sucesso = $repo->inserirAgendamento($agendamento);


if ($sucesso) {
    $response =  json_encode(['success' => true, 'message' => 'Agendamento realizado com sucesso!']);
} else {
    $response =  json_encode(['success' => true, 'message' => 'Não foi possível agendar!']);
}

echo $response;

?>