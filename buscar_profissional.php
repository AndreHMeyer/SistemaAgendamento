<?php

header('Content-Type: application/json');
include "../SistemaAgendamento/bancoDeDados/RepositorioPessoas.php";

$campo_busca = isset($_REQUEST['campo_pesquisa']) ? $_REQUEST['campo_pesquisa'] : "";
$id_profissional = isset($_REQUEST['id_profissional']) ? $_REQUEST['id_profissional'] : "";

$repositorioProfissionais = new \Database\RepositorioPessoas();

if (!empty($id_profissional)) {
    $profissionais = $repositorioProfissionais->obterProfissionalPorId($id_profissional);

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


        $pessoa[$idProfissional] = array(
            "iniciais_nome" => $firstLeterName . $firstLeterMidle,
            'nome' => $nomeCompleto,
            "email" => $profissional->getEmail(),
            "especialidade" => $profissional->getEspecialidade(),
            "cpf" => $profissional->getCpf(),
            "data_nascimento" =>$profissional->getDataNascimento(),
            "telefone" => $profissional->getTelefone(),
            "crm" => $profissional->getCrm(),
            "endereco" => $profissional->getEndereco()

        );
    }


    echo json_encode(["response" => $pessoa]);
} else {
    $pessoa = array(
        'nome' => "Rúbia Roberta",
        "cpf" => '126.160.809.74',
        "data_nascimento" => "26/11/2023",
        "telefone" => '4823847230',
        "email" => 'rubia@teste.hsadhasd',
        "crm" => '35356',
        "conselho" => 'TESTE',
        "crm_estado" => 'SC',
        "endereco" => 'Rua Aldhemar Veiga'

    );

    echo json_encode(["response" => $pessoa]);
}

