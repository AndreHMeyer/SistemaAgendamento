

<?php
    session_start();

    if(!isset($_SESSION['usuario'])) { 
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
                        <i class="fas fa-search"><img src="img/icon_filtro.png" alt="Icone filtro pesquisa"
                                style="width: 20px;"></i>
                    </button>
                </div>
                <div class="input-group-append search">
                    <button class="btn" type="button">
                        <i class="fas fa-search"><img src="img/icon_search.png" alt="Icone lopa de pesquisa"
                                style="width: 15px;"></i>
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

    <div id="modalProfissional" class="modal fade" aria-labelledby="modalProfissional">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="img/person_icon.png" id="profissional-image" class="ml-2"
                            width="30px;"> <span id="profissional-text"></span> Profissional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formProfissional">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control col-sm-12" id="nome" name="nome"
                                placeholder="Nome Sobrenome" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf"
                                        placeholder="123.456.789-10" required>
                                </div>
                                <div class="col">
                                    <label for="dataNascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento"
                                        placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone"
                                        placeholder="(99)9 9999-1234" required>
                                </div>
                                <div class="col">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="nome@email.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="crm">No. Conselho</label>
                                    <input type="text" class="form-control" id="crm" name="crm" placeholder="123456"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="conselho">Conselho</label>
                                    <div class="input-group">
                                        <input type="conselho" class="form-control" id="conselho" name="consl"
                                            placeholder="CRM" required>
                                        <select class="form-control" id="crm-estado" name="crm-estado">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco"
                                        placeholder="Rua 123, número 456" required>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn modal-cancelar-excluir"
                            style="margin-top: 5px;float: left; color: red;" data-dismiss="modal">Excluir</button>
                        <button type="submit" class="btn btn-primary" id="BtnCadastroProfissional"
                            onclick="cadastrarProfissional();" style="margin-top: 5px;float: right">Salvar</button>
                        <button type="submit" class="btn btn-primary" id="BtnEditarProfissional" onclick="editar();"
                            style="margin-top: 5px;float: right">Salvar</button>
                        <button type="button" class="btn modal-cancelar-excluir"
                            style="margin-top: 5px;float: right; color: red; margin-right: 30px;"
                            data-dismiss="modal">Cancelar</button>
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
                        <p id="mensagemDoModal" class="ml-3"
                            style="font-size: 20px; padding-top: 15px; padding-left: -15px;"></p>
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
        $('#modalProfissional').modal('show')
    }

    $(document).ready(function () {
        $(function () { $("#nav-head").load("navbar_head.html"); });
        $(function () { $("#nav-lateral").load("navbar_lateral.php"); });
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
            success: function (response) {
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
                    <td style="vertical-align: middle; text-align:center;">${profissional.prox_data}</td>
                    <td class="icon" style="vertical-align: middle;">
                        <div class="icon-container">
                            <span><img src="img/icon_lapis.png" data-toggle="modal" data-target="#modalProfissional" onClick=buscarDadosEdicao("${key}")></span>
                            <span><img src="img/icon_lixeira.png" onclick="excluir('${key}')"></span>
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


    function buscarDadosEdicao(id) {
        let id_profissional = id;

        $('#profissional-text').text('Editar');

        $('#BtnEditarProfissional').show();
        $('#BtnCadastroProfissional').hide();

        const url = "../SistemaAgendamento/buscar_profissional.php";

        $.ajax({
            url: url,
            data: { id_profissional: id_profissional },
            success: function (response) {
                // console.log(response);
                var data = response.response;
                const dataNascimentoFormatada = formatDate(data.data_nascimento);

                $('#nome').val(data.nome);
                $('#cpf').val(data.cpf);
                $('#dataNascimento').val(dataNascimentoFormatada);
                $('#telefone').val(data.telefone);
                $('#email').val(data.email);
                $('#crm').val(data.crm);
                $('#conselho').val(data.conselho);
                $('#crm-estado').val(data.crm_estado);
                $('#endereco').val(data.endereco);


            }
        });

        const dadosAlterados = {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            data_nascimento: $('#dataNascimento').val(),
            telefone: $('#telefone').val(),
            email: $('#email').val(),
            crm: $('#crm').val(),
            conselho: $('#conselho').val(),
            crm_estado: $('#crm-estado').val(),
            endereco: $('#endereco').val()
        };

        editar(dadosAlterados);
    }

    function editar(dados) {
        $('#formProfissional').on('submit', function (event) {
            event.preventDefault();
            console.log(dados);
        });


    }

    function cadastrarProfissional() {
        let nome = $('#nome').val();
        let cpf = $('#cpf').val();
        let data_nascimento = $('#dataNascimento').val();
        let telefone = $('#telefone').val();
        let email = $('#email').val();
        let crm = $('#crm').val();
        let conselho = $('#conselho').val();
        let crm_estado = $('#crm-estado').val();
        let endereco = $('#endereco').val();

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
            success: function (response) {

                if (response && response.success) {
                    $('#modalProfissional').modal('hide');
                    document.getElementById('formProfissional').reset();
                    $('#mensagemDoModal').text(response.message);
                    $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                    $('#modalResponse').modal('show');
                } else {
                    $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                    $('#mensagemDoModal').text(response.message);
                    $('#modalResponse').modal('show');
                }
            },
            error: function (error) {
                $('#iconeDoModal').html('<i class="bi bi-exclamation-triangle text-danger"></i>');
                $('#mensagemDoModal').text(error);
                $('#modalResponse').modal('show');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {

        $('.add-agenda').on('click', function () {
            $('#profissional-text').text('Cadastrar');
            $('#BtnEditarProfissional').hide();
            $('#BtnCadastroProfissional').show();
            document.getElementById('formProfissional').reset();
        });

        $('#BtnCadastroProfissional').on('click', function (event) {
            $('#formProfissional').on('submit', function (event) {
                event.preventDefault();
            });
        });

        $('.modal-cancelar-excluir').on('click', function (event) {
            document.getElementById('formProfissional').reset();
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
