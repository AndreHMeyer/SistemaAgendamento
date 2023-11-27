<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$user = "root";
$conexao = new PDO("mysql:host=localhost;dbname=sistemaagendamento", $user);

$queryPaciente = "SELECT id, nome FROM pessoa WHERE especialidade IS NULL";
$exePaciente = $conexao->prepare($queryPaciente);
$exePaciente->execute();

while ($rowPaciente = $exePaciente->fetch(PDO::FETCH_ASSOC)) {
    $paciente[] = ['idPessoa' => $rowPaciente['id'], 'nome' => $rowPaciente['nome']];
}

$queryProfissional = "SELECT id, nome FROM pessoa WHERE especialidade IS NOT NULL";
$exeProfissional = $conexao->prepare($queryProfissional);
$exeProfissional->execute();

while ($rowProfissional = $exeProfissional->fetch(PDO::FETCH_ASSOC)) {
    $profissional[] = ['idProfissional' => $rowProfissional['id'], 'nome' => $rowProfissional['nome']];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Remember Med</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="includes/bootstrap-4.0.0/bootstrap-4.0.0/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="includes/icons-main/font/bootstrap-icons.css" />
    <script src="includes/jquery-3.7.1.js"></script>
    <script src="includes/bootstrap-4.0.0/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</head>
<style>
    .search-container {
        display: flex;
        align-items: center;
    }

    .title {
        margin-left: 10px;
    }

    .search-container,
    .title {
        margin-top: 80px;
        margin-left: 80px;
    }

    .add-agenda {
        margin-left: 40px;
        margin-top: 80px;
        background-color: #5272E9 !important;
        color: white !important;
    }

    .search-container input {
        border: 1px solid #5272E9;
        border-right: none;
    }

    .input-group button {
        border: 1px solid #5272E9;
        background: transparent;
        border-left: none;
    }

    .filtro button {
        border-right: none;
    }

    .input-group button:hover,
    .input-group button:active {
        background-color: #f5f5f5;
    }

    .table-container {
        border-radius: 10px;
        border: 1px solid #D0D0CE;
        margin-left: 80px;
        margin-top: 30px;
        width: 1400px;
        overflow: hidden;
    }

    .cabecalho {
        color: #6A6A65;
        background-color: #F8F8F8;
        border-bottom: none;
        border-radius: 100px;
        border-radius: 10px 10px 0 0;
    }

    .table {
        border-collapse: collapse;
    }

    .icon img {
        width: 16px;
        margin-right: 10px;
        cursor: pointer;
    }

    .info-text {
        font-weight: 600;

    }

    .ocupacao {
        color: #8B7835;
        background-color: #FFE68B;
        border-radius: 50px;
        padding: 5px 10px;
        display: inline-block;
        line-height: 1;
    }

    .disponibilidade {
        color: #3F8B35;
        background-color: #E5F5E4;
        border-radius: 50px;
        margin-left: 10px;
        padding: 5px 10px;
        display: inline-block;
        line-height: 1;

    }

    .iniciais {
        color: #004DEB;
        background-color: #F0F4FF;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .situcao {
        border-radius: 50px;
        padding: 1px 9px;
        display: inline-block;
        line-height: 1.4;
    }

    .ies_ativa {
        color: #3F8B35;
        background-color: #E5F5E4;
        font-weight: 600;
    }

    .ies_inativa {
        color: #4E4E4E;
        background-color: #E5F5E4;
        font-weight: 600;
    }

    .ies_bloqueada {
        color: #E61E00;
        background-color: #FFDAD5;
        font-weight: 600;
    }

    .checkProfissional {
        margin-left: 30px;
        margin-right: 0px;
    }

    .modal-cancelar-excluir {
        background-color: transparent;
    }

    .icon-container {
        display: flex;
        align-items: center;

    }

    .icon-container span {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 1px;
        /* Ajuste o espaçamento conforme necessário */
    }

    .icon-container span:hover {
        background-color: #D0D0CE;
    }

    .icon-container img {
        margin-left: 9px;
    }
</style>

<body>

    <div id="nav-head"></div>
    <div id="nav-lateral"></div>

    <div class="d-flex align-items-center">
        <h2 class="title" style="font-weight: bold;">Agendas</h2>
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="form-control search-bar" style="width: 800px;">
                <div class="input-group-append filtro">
                    <button class="btn" type="button">
                        <i class="fas fa-search"><img src="img/icon_filtro.png" alt="Icone filtro pesquisa" style="width: 20px;"></i>
                    </button>
                </div>
                <div class="input-group-append search">
                    <button class="btn" type="button">
                        <i class="fas fa-search"><img src="img/icon_search.png" alt="Icone lopa de pesquisa" style="width: 15px;"></i>
                    </button>
                </div>

            </div>
        </div>
        <button class="btn add-agenda" type="button" onclick="abrirModal();"> +
            Adicionar </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="cabecalho">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="sortable">Profissional <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable">Situação<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="width: 250px;">Ocupação<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="text-align:center;">Próxima data livre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody style="height: 50px;">

            </tbody>
        </table>
    </div>

    <div id="modalConsulta" class="modal" aria-labelledby="modalConsulta">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="img/person_icon.png" id="consulta-image" class="ml-2" width="30px;"> <span id="consulta-text"></span> Consulta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formConsulta" name="formConsulta">
                        <div class="form-group">
                            <label for="tipoConsulta">Tipo de consulta</label>
                            <input type="text" class="form-control col-sm-12" id="tipoConsulta" name="tipoConsulta" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="dataInicioConsulta">Data inicial da consulta</label>
                                    <input type="datetime-local" class="form-control" id="dataInicioConsulta" name="dataInicioConsulta" required>
                                </div>
                                <div class="col">
                                    <label for="dataFimConsulta">Data final da consulta</label>
                                    <input type="datetime-local" class="form-control" id="dataFimConsulta" name="dataFimConsulta" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="pacianteConsulta">Paciente</label>
                                <select class="form-control" id="pacienteConsulta" name="pacienteConsulta" required>
                                    <option selected>Selecione um paciente</option>
                                    <?php
                                    foreach ($paciente as $key) {
                                        echo '<option value="' . $key['idPessoa'] . '">' . $key['nome'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="profissionalConsulta">Profissional</label>
                                <select class="form-control" id="profissionalConsulta" name="profissionalConsulta" required>
                                    <option selected>Selecione um profissional</option>
                                    <?php
                                    foreach ($profissional as $key) {
                                        echo '<option value="' . $key['idProfissional'] . '">' . $key['nome'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button onclick="cadastrarConsulta()" class="btn btn-primary" id="BtnCadastroConsulta" style="margin-top: 5px;float: right">Salvar</button>
                        <button type="button" class="btn btn-link" style="margin-top: 5px;float: right; color: red; margin-right: 30px;">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalResponse" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Mensagem
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="icon-message d-flex align-items-center">
                        <span id="iconeDoModal" style="font-size: 2rem;"></span> <!-- Ícone maior -->
                        <p id="mensagemDoModal" class="ml-3" style="font-size: 20px; padding-top: 15px; padding-left: -15px;"></p>
                        <!-- Mensagem maior e com margem à esquerda -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    function abrirModal() {
        $('#modalConsulta').modal('show')
    }

    var inicio = document.getElementById('dataInicioConsulta');
    var fim = document.getElementById('dataFimConsulta');
    var dataAtual = new Date();
    var ano = dataAtual.getFullYear();
    var mes = ('0' + (dataAtual.getMonth() + 1)).slice(-2); // Adiciona 1 ao mês porque os meses são zero-indexed
    var dia = ('0' + dataAtual.getDate()).slice(-2);
    var hora = ('0' + dataAtual.getHours()).slice(-2);
    var minutos = ('0' + dataAtual.getMinutes()).slice(-2);

    var dataHoraAtual = ano + '-' + mes + '-' + dia + 'T' + hora + ':' + minutos;
    var dataHoraAtualMaisUm = ano + '-' + mes + '-' + dia + 'T' + hora + ':' + minutos;

    inicio.min = dataHoraAtual;
    fim.min = dataHoraAtual;

    $(document).ready(function() {
        $(function() {
            $("#nav-head").load("navbar_head.html");
        });
        $(function() {
            $("#nav-lateral").load("navbar_lateral.php");
        });
    });

    function visualizarAgenda(id_profissional) {


        if (id_profissional) {
            const url = 'calendario.php?id_profissional=' + id_profissional;
            window.location = url;
        }
    }

    function buscaInfoTable() {
        $.ajax({
            url: '../SistemaAgendamento/buscar_profissional.php',
            success: function(response) {
                createTable(response);

            }
        });
    }

    function createTable(data) {
        const table = document.querySelector('.table-container table tbody');

        for (const key in data.response) {
            if (data.response.hasOwnProperty(key)) {
                const profissional = data.response[key];
                const row = document.createElement('tr');

                row.classList.add('tr-profissional');
                // row.setAttribute('onclick', `visualizarAgenda(${key})`);

                row.innerHTML = `
                    <td style="vertical-align: middle;"></td>
                    <td style="display: flex; align-items: center;">
                        <a href="calendario.php?id_profissional=${key}" class="iniciais">${profissional.iniciais_nome}</a>
                        <span style="margin-left: 10px;">${profissional.email}</span>
                    </td>
                    <td style="vertical-align: middle;">${profissional.situacao}</td>
                    <td class="info-text" style="vertical-align: middle;">
                        <span class="ocupacao">${profissional.ocupacao}</span>
                        <span class="disponibilidade">${profissional.disponibilidade}</span>
                    </td>
                    <td style="vertical-align: middle; text-align:center;">${profissional.prox_data}</td>`;

                table.appendChild(row);
            }
        }
    }


    // function formatDate(data) {
    //     const partes = data.split('/');
    //     if (partes.length === 3) {
    //         // Reorganize as partes para o formato aaaa-mm-dd
    //         return `${partes[2]}-${partes[1]}-${partes[0]}`;
    //     }
    //     return data; // Retorne a data no formato original se não for possível formatar
    // }


    // function buscarDadosEdicao(id) {


    //     $('#consulta-text').text('Editar');

    //     $('#BtnEditarConsulta').show();
    //     $('#BtnCadastroConsulta').hide();

    //     const url = "../SistemaAgendamento/buscar_consulta.php";

    //     $.ajax({
    //         url: url,
    //         data: {
    //             id: id
    //         },
    //         success: function(response) {
    //             // console.log(response);
    //             var data = response.response;
    //             const DataInicio = formatDate(data.DataInicio);
    //             const dataConsultaFimFormatada = formatDate(data.DataFim);
    //             $('#observacao').val(data.observacao);
    //             $('#DataInicio').val(dataConsultaInicioFormatada);
    //             $('#DataFim').val(dataConsultaFimFormatada);
    //             $('#idPessoal').val(data.idPessoal);
    //             $('#idProfissional').val(data.idProfissional);
    //         }
    //     });

    //     const dadosAlterados = {
    //         nome: $('#nome').val(),
    //         cpf: $('#cpf').val(),
    //         data_nascimento: $('#dataNascimento').val(),
    //         telefone: $('#telefone').val(),
    //         email: $('#email').val(),
    //         crm: $('#crm').val(),
    //         conselho: $('#conselho').val(),
    //         crm_estado: $('#crm-estado').val(),
    //         endereco: $('#endereco').val()
    //     };

    //     editar(dadosAlterados);
    // }

    // function editar(dados) {
    //     $('#formProfissional').on('submit', function(event) {
    //         event.preventDefault();
    //         console.log(dados);
    //     });


    // }

    function cadastrarConsulta() {
        $('#modalConsulta').modal('hide');
        let DataInicio = document.getElementById("dataInicioConsulta").value;
        let DataFim = document.getElementById("dataFimConsulta").value;
        let observacao = $('#tipoConsulta').val();
        let idPessoa = document.getElementById("pacienteConsulta").value;
        let idProfissional = document.getElementById("profissionalConsulta").value;
        $.ajax({
            url: "../cadastrarConsulta.php",
            method: "POST",
            dataType: 'json',
            data: {
                DataInicio: DataInicio,
                DataFim: DataFim,
                observacao: observacao,
                idPessoa: idPessoa,
                idProfissional: idProfissional
            },
            success: function(response) {

                if (response && response.success) {
                    
                    document.getElementById('formConsulta').reset();
                    $('#mensagemDoModal').text(response.message);
                    $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                    $('#modalResponse').modal('show');
                } else {
                    $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                    $('#mensagemDoModal').text(response.message);
                    $('#modalResponse').modal('show');
                }
            }
            // ,
            // error: function(error) {
            //     $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
            //     $('#mensagemDoModal').text(error);
            //     $('#modalResponse').modal('show');
            // }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {

        buscaInfoTable();
    });
</script>

</html>