<?php

header('Content-Type: application/json');
include "../SistemaAgendamento/bancoDeDados/RepositorioPessoas.php";

$id_paciente = isset($_REQUEST['id_paciente']) ? $_REQUEST['id_paciente'] : "";
$campo_pesquisa = isset($_REQUEST['campoPesquisa']) ? $_REQUEST['campoPesquisa'] : "";

$repositorioPacientes = new \Database\RepositorioPessoas();

$pacientes = [];

if (!empty($id_paciente)) {

    $paciente = $repositorioPacientes->obterPessoaPorId($id_paciente);

    $pessoa = array(
        'nome' => $paciente->getNome(),
        "email" => $paciente->getEmail(),
        "especialidade" => $paciente->getEspecialidade(),
        "cpf" => $paciente->getCpf(),
        "data_nascimento" =>$paciente->getDataNascimento(),
        "telefone" => $paciente->getTelefone(),
        "numero_conselho" => $paciente->getNumeroConselho(),
        "tipo_conselho" => $paciente->getTipoConselho(),
        "estado_conselho" => $paciente->getEstadoConselho(),
        "endereco" => $paciente->getEndereco()

    );


} else {
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
                "data_nascimento" =>$paciente->getDataNascimento(),
                "telefone" => $paciente->getTelefone(),
                "crm" => $paciente->getNumeroConselho(),
                "endereco" => $paciente->getEndereco()

            );
        }




    }
}

echo json_encode(["response" => $pessoa]);



//
//if (!empty($campo_pesquisa)) {
//    $idPaciente = 5;
//
//    $nomeCompleto = "Matheus Henrique Perreira";
//
//    $exploNome = explode(' ', $nomeCompleto);
//    $firstLeterName = substr($exploNome[0], 0, 1);
//    $firstLeterMidle = substr(end($exploNome), 0, 1);
//
//    $paciente[$idPaciente] = array(
//        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
//        "nome" => $nomeCompleto,
//        "cpf" => '126.160.809-64',
//        "email" => 'mat@teste.com.br',
//        "telefone" => '(47) 99999-9999',
//        "ultima_consulta" => '05/01/2023'
//    );
//} elseif (!empty($id_paciente)) {
//
//    $paciente = array(
//        "nome" => 'Rúbia Roberta Cacemiro de Souza',
//        "cpf" => '126.160.809-64',
//        "data_nascimento" => '04/12/2003',
//        "telefone" => '(47) 99999-9999',
//        "email" => 'rubia@teste.com.br',
//        "endereco" => 'Rua Teste 20'
//
//    );
//} else {
//
//    $idPaciente = 5;
//
//    $nomeCompleto = "Rúbia Roberta Cacemiro de Souza";
//
//    $exploNome = explode(' ', $nomeCompleto);
//    $firstLeterName = substr($exploNome[0], 0, 1);
//    $firstLeterMidle = substr(end($exploNome), 0, 1);
//
//    $paciente[$idPaciente] = array(
//        "iniciais_nome" => $firstLeterName . $firstLeterMidle,
//        "nome" => $nomeCompleto,
//        "cpf" => '120.140.180-74',
//        "email" => 'rubia@teste.com.br',
//        "telefone" => '(47) 99999-9999',
//        "ultima_consulta" => '05/01/2023'
//    );
//}





