<?php

use Database\RepositorioUsuario;

include "../SistemaAgendamento/bancoDeDados/RepositorioUsuario.php";

header('Content-Type: application/json');

$id_usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : "";
$campo_pesquisa = isset($_REQUEST['campoPesquisa']) ? $_REQUEST['campoPesquisa'] : "";

$repoUsuarios = new RepositorioUsuario();
$usuarios = [];


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
        "telefone" => '(47) 99999-9999'
    );
} elseif (!empty($id_usuario)) {

    $usuario = $repoUsuarios->obterUsuarioById($id_usuario);

    if ($usuario) {

        $idUsuario = $usuario->getId();
        $nomeUsuario = $usuario->getNomeUsuario();
        $emailUsuario = $usuario->getEmail();
        $senha = $usuario->getSenha();

        $user = array(
            "idUsuario" => $idUsuario,
            "nome" => $nomeUsuario,
            "email" => $emailUsuario
        );
    }

} else {

    $usuarios = $repoUsuarios->obterTodosUsuarios();

    if ($usuarios) {
        foreach( $usuarios as $usuario) {



            $idUsuario = $usuario->getId();
            $nomeUsuario = $usuario->getNomeUsuario();
            $emailUsuario = $usuario->getEmail();
            $senha = $usuario->getSenha();

            $exploNome = explode(' ', $nomeUsuario);
            $firstLeterName = substr($exploNome[0], 0, 1);
            $firstLeterMidle = substr(end($exploNome), 0, 1);

            $user[$idUsuario] = array(
                "idUsuario" => $idUsuario,
                "iniciais_nome" => $firstLeterName . $firstLeterMidle,
                "nome" => $nomeUsuario,
                "email" => $emailUsuario
            );
        }
    }

//    $usuario[$idUsuario] = array(
//        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
//        "nome" => $nomeCompleto,
//        "email" => 'rubia@teste.com.br',
//        "telefone" => '(47) 99999-9999'
//    );
}

echo json_encode(["response" => $user]);
