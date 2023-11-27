<?php

$user = "root";
$conexao = new PDO("mysql:host=localhost;dbname=sistemaagendamento", $user);

$observacao = isset($_REQUEST['tipoConsulta']) ? $_REQUEST['tipoConsulta'] : "";
$idPessoa = isset($_REQUEST['pacienteConsulta']) ? $_REQUEST['pacienteConsulta'] : "";
$idProfissional = isset($_REQUEST['profissionalConsulta']) ? $_REQUEST['profissionalConsulta'] : "";
$DataInicio = isset($_REQUEST['dataInicioConsulta']) ? $_REQUEST['dataInicioConsulta'] : "";
$DataFim = isset($_REQUEST['dataFimConsulta']) ? $_REQUEST['dataFimConsulta'] : "";

$DataInicio = str_replace("T", " ", $DataInicio);
$DataInicio .= ":00";
$DataFim = str_replace("T", " ", $DataFim);
$DataFim .= ":00";

$queryConsulta = "INSERT INTO consulta (observacao, idPessoa, idProfissional, DataInicio, DataFim)
                    VALUES ('" . $observacao . "', " . $idPessoa . ", " . $idProfissional . ", '" . $DataInicio . "', '" . $DataFim . "')";

$exeConsulta = $conexao->prepare($queryConsulta);
$exeConsulta->execute();



?>