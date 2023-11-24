<?php

header('Content-Type: application/json');
include "../SistemaAgendamento/bancoDeDados/RepositorioPessoas.php";

$campo_busca = isset($_REQUEST['campo_pesquisa']) ? $_REQUEST['campo_pesquisa'] : "";
$id_profissional = isset($_REQUEST['id_profissional']) ? $_REQUEST['id_profissional'] : "";

$repositorioProfissionais = new \Database\RepositorioPessoas();

$profissionais = [];



if (!empty($id_profissional)) {
    $profissional = $repositorioProfissionais->obterProfissionalPorId($id_profissional);

    $pessoa = array(
        'nome' => $profissional->getNome(),
        "email" => $profissional->getEmail(),
        "especialidade" => $profissional->getEspecialidade(),
        "cpf" => $profissional->getCpf(),
        "data_nascimento" =>$profissional->getDataNascimento(),
        "telefone" => $profissional->getTelefone(),
        "numero_conselho" => $profissional->getNumeroConselho(),
        "tipo_conselho" => $profissional->getTipoConselho(),
        "estado_conselho" => $profissional->getEstadoConselho(),
        "endereco" => $profissional->getEndereco()

    );

} else {
    $profissionais = $repositorioProfissionais->obterTodosProfissionais();

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
                "crm" => $profissional->getNumeroConselho(),
                "endereco" => $profissional->getEndereco()

            );
        }


    }




}

echo json_encode(["response" => $pessoa]);