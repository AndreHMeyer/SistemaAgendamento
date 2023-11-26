<?php

header('Content-Type: application/json');

$id_usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : "";
$campo_pesquisa = isset($_REQUEST['campoPesquisa']) ? $_REQUEST['campoPesquisa'] : "";


if (!empty($campo_pesquisa)) {
    $idUsuario = 5;

    $nomeCompleto = "Matheus Henrique Perreira";

    $exploNome = explode(' ', $nomeCompleto);
    $firstLeterName = substr($exploNome[0], 0, 1);
    $firstLeterMidle = substr(end($exploNome), 0, 1);

    $usuario[$idUsuario] = array(
        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
        "nome" => $nomeCompleto,
        "email" => 'mat@teste.com.br',
        "telefone" => '(47) 99999-9999',
        "ultima_consulta" => '05/01/2023'
    );
} elseif (!empty($id_usuario)) {

    $usuario = array(
        "nome" => 'Rúbia Roberta Cacemiro de Souza',
        "email" => 'rubia@teste.com.br',
        "telefone" => '(47) 99999-9999'
    );
} else {

    $idUsuario = 5;

    $nomeCompleto = "Rúbia Roberta Cacemiro de Souza";

    $exploNome = explode(' ', $nomeCompleto);
    $firstLeterName = substr($exploNome[0], 0, 1);
    $firstLeterMidle = substr(end($exploNome), 0, 1);

    $usuario[$idUsuario] = array(
        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
        "nome" => $nomeCompleto,
        "email" => 'rubia@teste.com.br',
        "telefone" => '(47) 99999-9999',
        "ultima_consulta" => '05/01/2023'
    );
}




echo json_encode(["response" => $usuario]);
