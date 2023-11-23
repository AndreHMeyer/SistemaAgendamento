<?php

header('Content-Type: application/json');
include "../SistemaAgendamento/bancoDeDados/RepositorioPessoas.php";

$campo_busca = isset($_REQUEST['campo_pesquisa']) ? $_REQUEST['campo_pesquisa'] : "";
$id_profissional = isset($_REQUEST['id_profissional']) ? $_REQUEST['id_profissional'] : "";

$repositorioProfissionais = new \Database\RepositorioPessoas();

if (!empty($id_profissional)) {
    // $profissionais = $repositorioProfissionais->obterProfissionalPorId($id_profissional);
    $profissionais = false;
} else {
    $profissionais = $repositorioProfissionais->obterTodosProfissionais();
}

$ies_situacao = "Ativo";
if ($profissionais) {
    foreach ($profissionais as $profissional) {
        $idProfissional = $profissional->getId();
        $nomeCompleto = $profissional->getNome();

        $exploNome = explode(' ', $nomeCompleto);
        $firstLeterName = substr($exploNome[0], 0, 1);
        $firstLeterMidle = substr(end($exploNome), 0, 1);

//        if ($idProfissional == 2) {
//            $ies_situacao = "Inativo";
//        }
//
//        if ($idProfissional == 4) {
//            $ies_situacao = "Bloqueado";
//        }
//
//        if ($ies_situacao == "Ativo") {
//            $situacao = " <span class='situcao ies_ativa'>" . $ies_situacao . "</span>";
//        } elseif ($ies_situacao == "Inativo") {
//            $situacao = " <span class='situcao ies_inativa'>" . $ies_situacao . "</span>";
//        } elseif ($ies_situacao == "Bloqueado") {
//            $situacao = " <span class='situcao ies_bloqueada'>" . $ies_situacao . "</span>";
//        } else {
//            $situacao = " <span class='situcao ies_bloqueada'> Indefinida </span>";
//        }


        $agenda[$idProfissional] = array(
            'nome' => $nomeCompleto,
            "iniciais_nome" => $firstLeterName . $firstLeterMidle,
            "email" => $profissional->getEmail(),
            "especialidade" => $profissional->getEspecialidade(),
            "ocupacao" => '87% Ocupada',
            "disponibilidade" => '13% Livre',
            "prox_data" => '05/01/2023'

        );
    }


    echo json_encode(["response" => $agenda]);
} else {
    $agenda = array(
        'nome' => "Rúbia Roberta",
        "cpf" => '126.160.809.74',
        "data_nascimento" => "26/11/2023",
        "telefone" => '000000000',
        "email" => 'rubia@teste.hsadhasd',
        "crm" => '12548',
        "conselho" => 'CRM',
        "crm" => '12548',
        "crm" => '12548',
        "crm_estado" => 'SC',
        "endereco" => 'Rua Aldhemar Veiga'

    );

    echo json_encode(["response" => $agenda]);
}

