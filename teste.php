<?php

use Database\ConexaoDB;
use Database\RepositorioPessoas;
use Database\RepositorioUsuario;
use Pessoa\Pessoa;


//include(".\bancoDeDados\ConexaoDB.php");
require_once(".\bancoDeDados\RepositorioPessoas.php");
require_once (".\model\usuarios\Login.php");
require_once (".\bancoDeDados\RepositorioUsuario.php");

$repositorioPacientes = new RepositorioPessoas();

$pacientes = $repositorioPacientes->obterTodosPacientes();

if ($pacientes) {
    foreach ($pacientes as $paciente) {
        $idPaciente = $paciente->getId();
        $nomeCompleto = $paciente->getNome();

        $exploNome = explode(' ', $nomeCompleto);
        $firstLeterName = substr($exploNome[0], 0, 1);
        $firstLeterMidle = substr(end($exploNome), 0, 1);

        $pessoa[$idPaciente] = array(
            "iniciais_nome" => $firstLeterName . $firstLeterMidle,
            'nome' => $nomeCompleto,
            "email" => $paciente->getEmail(),
            "especialidade" => $paciente->getEspecialidade(),
            "cpf" => $paciente->getCpf(),
            "data_nascimento" => $paciente->getDataNascimento(),
            "telefone" => $paciente->getTelefone(),
            "crm" => $paciente->getNumeroConselho(),
            "endereco" => $paciente->getEndereco()

        );

        var_dump($pessoa[$idPaciente]);
    };
}

