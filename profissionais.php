<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
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
        margin-right: 0;
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
        <h2 class="title" style="font-weight: bold;">Profissionais</h2>
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
                    <th scope="col" class="sortable">E-mail<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="width: 250px;">Especialidade<i class="fas fa-sort"></i></th>
                    <!--                    <th scope="col" class="sortable" style="text-align:center;">Próxima data livre</th>-->
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody style="height: 50px;">

            </tbody>
        </table>
    </div>

    <div id="modalProfissional" class="modal fade" aria-labelledby="modalProfissional">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="img/person_icon.png" id="profissional-image" class="ml-2" width="30px;"> <span id="profissional-text"></span> Profissional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_profissional">
                        <div class="form-group">
                            <label for="nomeProf">Nome</label>
                            <input type="text" class="form-control col-sm-12" id="nomeProf" name="nomeProf" placeholder="Nome Sobrenome" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="cpfProf">CPF</label>
                                    <input type="text" class="form-control" id="cpfProf" name="cpfProf" placeholder="123.456.789-10" required>
                                </div>
                                <div class="col">
                                    <label for="dataNascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="dataNascimentoProf" name="dataNascimentoProf" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" id="telefoneProf" name="telefoneProf" placeholder="(99)9 9999-1234" required>
                                </div>
                                <div class="col">
                                    <label for="emailProf">E-mail</label>
                                    <input type="email" class="form-control" id="emailProf" name="emailProf" placeholder="nome@email.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="crm">No. Conselho</label>
                                    <input type="text" class="form-control" id="crm" name="crm" placeholder="123456" required>
                                </div>
                                <div class="col">
                                    <label for="conselho">Conselho</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="conselhoProf" name="conselhoProf" placeholder="CRM" required>
                                        <select class="form-control" id="crm-estado" name="crm-estado">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="enderecoProf">Endereço</label>
                                    <input type="text" class="form-control" id="enderecoProf" name="enderecoProf" placeholder="Rua 123, número 456" required>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn modal-cancelar-excluir" style="margin-top: 5px;float: left; color: red;" data-dismiss="modal">Excluir</button>
                        <button type="submit" class="btn btn-primary" id="BtnCadastro" onclick="cadastrarProfissional();" style="margin-top: 5px;float: right">Salvar</button>
                        <button type="submit" class="btn btn-primary" id="BtnEditar" style="margin-top: 5px;float: right">Salvar</button>
                        <button type="button" class="btn modal-cancelar-excluir" style="margin-top: 5px;float: right; color: red; margin-right: 30px;" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modalResponse" id="modalResponse" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title-response"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="icon-message d-flex align-items-center">
                        <span id="iconeDoModal" style="font-size: 2rem;"></span>
                        <p id="mensagemDoModal" class="ml-3" style="font-size: 20px; padding-top: 15px; padding-left: -15px;"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modalExcluir" id="modalExcluir" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Ação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="icon-message d-flex align-items-center">
                        <span style="font-size: 2rem;"><i class="bi bi-question-circle-fill text-warning"></i></span>
                        <p id="mensagemDeExclusao" class="ml-3" style="font-size: 20px; padding-top: 15px; padding-left: -15px;"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn modal-cancelar mr-auto" style="margin-top: 5px;float: left; color: red;" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" style="margin-top: 5px; float: right;" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>




</body>
<script>
    function abrirModal() {
        $('#modalProfissional').modal('show')
    }

    $(document).ready(function() {
        $(function() {
            $("#nav-head").load("navbar_head.html");
        });
        $(function() {
            $("#nav-lateral").load("navbar_lateral.php");
        });
    });

    function visualizarAgenda(id) {
        let id_profissional = id;

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
                        <span class="iniciais">${profissional.iniciais_nome}</span>
                        <span style="margin-left: 10px;">${profissional.nome}</span>
                    </td>
                    <td style="vertical-align: middle;">${profissional.email}</td>
                    <td style="vertical-align: middle;">${profissional.especialidade}</td>

                    <td class="icon" style="vertical-align: middle;">
                        <div class="icon-container">
                            <span onClick=buscarDadosEdicao("${key}")><img src="img/icon_lapis.png"></span>
                            <span onclick="excluir('${profissional.nome}', ${key})"><img src="img/icon_lixeira.png"></span>
                        </div>
                    </td>`;

                table.appendChild(row);
            }
        }
    }


    function formatDate(data) {
        const partes = data.split('/');
        if (partes.length === 3) {
            // Reorganize as partes para o formato aaaa-mm-dd
            return `${partes[2]}-${partes[1]}-${partes[0]}`;
        }
        return data; // Retorne a data no formato original se não for possível formatar
    }


    function cadastrarProfissional() {
        $('#form_profissional').on('submit', function(event) {
            event.preventDefault();

            let nome = $('#nomeProf').val();
            let cpf = $('#cpfProf').val();
            let data_nascimento = $('#dataNascimentoProf').val();
            let telefone = $('#telefoneProf').val();
            let email = $('#emailProf').val();
            let crm = $('#crm').val();
            let conselho = $('#conselhoProf').val();
            let crm_estado = $('#crm-estado').val();
            let endereco = $('#enderecoProf').val();

            $.ajax({
                url: "./controller/cadastrarProfissional.php",
                method: "POST",
                dataType: 'json',
                data: {
                    nome: nome,
                    cpf: cpf,
                    data_nascimento: data_nascimento,
                    telefone: telefone,
                    email: email,
                    crm: crm,
                    conselho: conselho,
                    crm_estado: crm_estado,
                    endereco: endereco
                },
                success: function(response) {

                    if (response && response.success) {
                        $('#modalProfissional').modal('hide');
                        document.getElementById('form_profissional').reset();
                        $('#mensagemDoModal').text(response.message);
                        $('.modal-title-response').text('Sucesso!!');
                        $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                        $('#modalResponse').modal('show');
                        $('#modalResponse .modal-footer .btn-primary').on('click', function() {
                            location.reload();
                        });

                    } else {
                        $('.modal-title-response').text('Mensagem de Erro');
                        $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                        $('#mensagemDoModal').text(response.message);
                        $('#modalResponse').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    $('.modal-title-response').text('Mensagem de Erro');
                    $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                    $('#mensagemDoModal').text(error);
                    $('#modalResponse').modal('show');
                }
            });
        });
    }


    function buscarDadosEdicao(id) {
        let id_profissional = id;

        $('#profissional-text').text('Editar');

        $('#BtnEditar').show();
        $('#BtnCadastro').hide();

        const url = "../SistemaAgendamento/buscar_profissional.php";

        $.ajax({
            url: url,
            data: {
                id_profissional: id_profissional
            },
            success: function(response) {
                var data = response.response;

                const dataNascimentoFormatada = formatDate(data.data_nascimento);

                $('#nomeProf').val(data.nome);
                $('#cpfProf').val(data.cpf);
                $('#dataNascimentoProf').val(dataNascimentoFormatada);
                $('#telefoneProf').val(data.telefone);
                $('#emailProf').val(data.email);
                $('#crm').val(data.crm);
                $('#conselhoProf').val(data.conselho);
                $('#crm-estado').val(data.crm_estado);
                $('#enderecoProf').val(data.endereco);

                $('#modalProfissional').modal('show');

                $('#BtnEditar').on('click', function() {

                    const dadosAlterados = {
                        nome: $('#nomeProf').val(),
                        cpf: $('#cpfProf').val(),
                        data_nascimento: $('#dataNascimentoProf').val(),
                        telefone: $('#telefoneProf').val(),
                        email: $('#emailProf').val(),
                        crm: $('#crm').val(),
                        conselho: $('#conselhoProf').val(),
                        crm_estado: $('#crm-estado').val(),
                        endereco: $('#enderecoProf').val()
                    };

                    editar(dadosAlterados);

                });
            }
        });
    }


    function editar(dados) {
        $('#form_profissional').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "./controller/editarProfissional.php",
                method: "POST",
                dataType: 'json',
                data: dados,
                success: function(response) {
                    if (response.success) {
                        $('#modalProfissional').modal('hide');
                        document.getElementById('form_profissional').reset();
                        location.reload();
                    } else {
                        $('.modal-title-response').text('Mensagem de Erro');
                        $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                        $('#mensagemDoModal').text(response.message);
                        $('#modalResponse').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    $('.modal-title-response').text('Mensagem de Erro');
                    $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                    $('#mensagemDoModal').text(status + " - " + error);
                    $('#modalResponse').modal('show');
                }
            });
        });
    }

    function excluir(den_profissional, id_profissional) {
        var den_profissional = den_profissional;
        var id_profissional = id_profissional;

        $('#modalExcluir').modal('show');
        $('#mensagemDeExclusao').html("Deseja excluir o cadastro do profissional <b>" + den_profissional + "</b> ?");

        $('#modalExcluir .modal-footer .btn-primary').on('click', function() {

            $('#modalExcluir').modal('hide');

            $.ajax({
                url: "./controller/excluirProfissional.php",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_profissional: id_profissional
                },
                success: function(response) {
                    if (response && response.success) {
                        $('#mensagemDoModal').text(response.message);
                        $('.modal-title-response').text('Sucesso!!');
                        $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                        $('#modalResponse').modal('show');
                        $('#modalResponse .modal-footer .btn-primary').on('click', function() {
                            location.reload();
                        });
                    } else {
                        console.error('Erro ao excluir o profissional:', response.message);
                        $('.modal-title-response').text('Mensagem de Erro');
                        $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                        $('#mensagemDoModal').text(response.message);
                        $('#modalResponse').modal('show');
                    }
                },
                error: function(error) {
                    $('.modal-title-response').text('Mensagem de Erro');
                    $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                    $('#mensagemDoModal').text(error);
                    $('#modalResponse').modal('show');
                }
            });
        });
    }



    document.addEventListener('DOMContentLoaded', function() {

        $('.add-agenda').on('click', function() {
            $('#profissional-text').text('Cadastrar');
            $('#BtnEditar').hide();
            $('#BtnCadastro').show();
            document.getElementById('form_profissional').reset();
        });

        $('#BtnCadastroProfissional').on('click', function(event) {
            $('#form_profissional').on('submit', function(event) {
                event.preventDefault();
            });
        });

        $('.modal-cancelar-excluir').on('click', function(event) {
            document.getElementById('form_profissional').reset();
        });


        const estados = [{
                sigla: 'AC',
                nome: 'Acre'
            },
            {
                sigla: 'AL',
                nome: 'Alagoas'
            },
            {
                sigla: 'AP',
                nome: 'Amapá'
            },
            {
                sigla: 'AM',
                nome: 'Amazonas'
            },
            {
                sigla: 'BA',
                nome: 'Bahia'
            },
            {
                sigla: 'CE',
                nome: 'Ceará'
            },
            {
                sigla: 'DF',
                nome: 'Distrito Federal'
            },
            {
                sigla: 'ES',
                nome: 'Espírito Santo'
            },
            {
                sigla: 'GO',
                nome: 'Goías'
            },
            {
                sigla: 'MA',
                nome: 'Maranhão'
            },
            {
                sigla: 'MT',
                nome: 'Mato Grosso'
            },
            {
                sigla: 'MS',
                nome: 'Mato Grosso do Sul'
            },
            {
                sigla: 'MG',
                nome: 'Minas Gerais'
            },
            {
                sigla: 'PA',
                nome: 'Pará'
            },
            {
                sigla: 'PB',
                nome: 'Paraíba'
            },
            {
                sigla: 'PR',
                nome: 'Paraná'
            },
            {
                sigla: 'PE',
                nome: 'Pernambuco'
            },
            {
                sigla: 'PI',
                nome: 'Piauí'
            },
            {
                sigla: 'RJ',
                nome: 'Rio de Janeiro'
            },
            {
                sigla: 'RN',
                nome: 'Rio Grande do Norte'
            },
            {
                sigla: 'RS',
                nome: 'Rio Grande do Sul'
            },
            {
                sigla: 'RO',
                nome: 'Rondônia'
            },
            {
                sigla: 'RR',
                nome: 'Roraíma'
            },
            {
                sigla: 'SC',
                nome: 'Santa Catarina'
            },
            {
                sigla: 'SP',
                nome: 'São Paulo'
            },
            {
                sigla: 'SE',
                nome: 'Sergipe'
            },
            {
                sigla: 'TO',
                nome: 'Tocantins'
            },
        ];

        const selectEstado = document.getElementById('crm-estado');

        for (const estado of estados) {
            const option = document.createElement('option');
            option.value = estado.sigla;
            option.textContent = estado.sigla + " - " + estado.nome;
            selectEstado.appendChild(option);
        }

        buscaInfoTable();
    });
</script>

</html>