<?php

use Database\ConexaoDB;
use Database\RepositorioPessoas;
use Database\RepositorioUsuario;
use Pessoa\Pessoa;


//include(".\bancoDeDados\ConexaoDB.php");
require_once(".\bancoDeDados\RepositorioPessoas.php");
require_once (".\model\usuarios\Login.php");
require_once (".\bancoDeDados\RepositorioUsuario.php");

$repoUsuarios = new RepositorioUsuario();

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
            "nomeUsuario" => $nomeUsuario,
            "emailUsuario" => $emailUsuario,
            "senha" => $senha
        );

        var_dump($user[$idUsuario]);
    }
}

