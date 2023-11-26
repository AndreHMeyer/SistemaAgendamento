<?php

header('Content-Type: application/json');

$id_paciente = isset($_REQUEST['id_paciente']) ? $_REQUEST['id_paciente'] : "";
$campo_pesquisa = isset($_REQUEST['campoPesquisa']) ? $_REQUEST['campoPesquisa'] : "";


if (!empty($campo_pesquisa)) {
    $idPaciente = 5;

    $nomeCompleto = "Matheus Henrique Perreira";

    $exploNome = explode(' ', $nomeCompleto);
    $firstLeterName = substr($exploNome[0], 0, 1);
    $firstLeterMidle = substr(end($exploNome), 0, 1);

    $paciente[$idPaciente] = array(
        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
        "nome" => $nomeCompleto,
        "cpf" => '126.160.809-64',
        "email" => 'mat@teste.com.br',
        "telefone" => '(47) 99999-9999',
        "ultima_consulta" => '05/01/2023'
    );
} elseif (!empty($id_paciente)) {

    $paciente = array(
        "nome" => 'Rúbia Roberta Cacemiro de Souza',
        "cpf" => '126.160.809-64',
        "data_nascimento" => '04/12/2003',
        "telefone" => '(47) 99999-9999',
        "email" => 'rubia@teste.com.br',
        "endereco" => 'Rua Teste 20'

    );
} else {

    $idPaciente = 5;

    $nomeCompleto = "Rúbia Roberta Cacemiro de Souza";

    $exploNome = explode(' ', $nomeCompleto);
    $firstLeterName = substr($exploNome[0], 0, 1);
    $firstLeterMidle = substr(end($exploNome), 0, 1);

    $paciente[$idPaciente] = array(
        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
        "nome" => $nomeCompleto,
        "cpf" => '120.140.180-74',
        "email" => 'rubia@teste.com.br',
        "telefone" => '(47) 99999-9999',
        "ultima_consulta" => '05/01/2023'
    );
}




echo json_encode(["response" => $paciente]);
