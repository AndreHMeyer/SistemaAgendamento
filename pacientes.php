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

    .add-paciente {
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

    .td_telefone {
        color: #6A6A65;
        background-color: #E5F5E4;
        border-radius: 50px;
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
        <h2 class="title" style="font-weight: bold;">Pacientes</h2>
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="form-control search-bar" style="width: 800px;" id="searchInput">
                <div class="input-group-append filtro">
                    <button class="btn" type="button">
                        <i class="fas fa-search"><img src="img/icon_filtro.png" alt="Icone filtro pesquisa" style="width: 20px;"></i>
                    </button>
                </div>
                <div class="input-group-append search">
                    <button class="btn" type="button" id='buttonSearch'>
                        <i class="fas fa-search"><img src="img/icon_search.png" alt="Icone lopa de pesquisa" style="width: 15px;"></i>
                    </button>
                </div>
                <ul id="searchResults" class="list-group" style="position: absolute; width: 800px; margin-top:38px;"></ul>
            </div>
        </div>
        <button class="btn add-paciente" type="button" onclick="abrirModal();"> +
            Adicionar </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="cabecalho">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="sortable">Nome <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable">Telefone<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="width: 250px;">E-mail<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="text-align:center;">Data Nascimento</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody style="height: 50px;">

            </tbody>
        </table>
    </div>
    </div>


    <div class="modal fade" id="modalPaciente">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="img/person_icon.png" id="paciente-image" class="ml-2" width="30px;"> <span id="paciente-text"></span> Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">

                    </div>
                    <form id="form_paciente">
                        <div class="form-group">
                            <label for="nomePac">Nome</label>
                            <input type="text" class="form-control col-sm-12" id="nomePac" name="nomePac" placeholder="Nome Sobrenome" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="cpfPac">CPF</label>
                                    <input type="text" class="form-control" id="cpfPac" name="cpfPac" placeholder="123.456.789-10" required>
                                </div>
                                <div class="col">
                                    <label for="dataNascimentoPac">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="dataNascimentoPac" name="dataNascimentoPac" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="telefonePac">Telefone</label>
                                    <input type="text" class="form-control" id="telefonePac" name="telefonePac" placeholder="(99)9 9999-1234" required>
                                </div>
                                <div class="col">
                                    <label for="emailPac">E-mail</label>
                                    <input type="email" class="form-control" id="emailPac" name="emailPac" placeholder="nome@email.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="enderecoPac">Endereço</label>
                                    <input type="text" class="form-control" id="enderecoPac" name="enderecoPac" placeholder="Rua 123, número 456" required>
                                </div>
                                <!-- <div class="col">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
                                </div> -->
                            </div>
                        </div>
<!--                        <button type="button" class="btn modal-cancelar-excluir" style="margin-top: 5px;float: left; color: red;" data-dismiss="modal">Excluir</button>-->
                        <button type="submit" class="btn btn-primary" id="BtnCadastro" onclick="cadastrarPaciente();" style="margin-top: 5px;float: right">Salvar</button>
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
        $('#modalPaciente').modal('show')
    }

    $(document).ready(function() {
        $(function() {
            $("#nav-head").load("navbar_head.html");
        });
        $(function() {
            $("#nav-lateral").load("navbar_lateral.php");
        });


        $('#senha_um, #senha_dois').hide();

        $('#mostrarSenhaUser').click(function() {
            verificarSenhas('senhaUser');
        });

        $('#mostrarRepSenha').click(function() {
            verificarSenhas('rep_senhaUser');
        });

        $('#senhaUser, #rep_senhaUser').focus(function() {
            $('#senhaError').text('');
            $(this).removeClass('is-invalid');
        });

        function verificarSenhas(inputId) {
            var senhaInput = $('#' + inputId);
            if (senhaInput.attr('type') === 'password') {
                senhaInput.attr('type', 'text');
            } else {
                senhaInput.attr('type', 'password');
            }
        }

        var campoPesquisa = $('.search-bar');

        campoPesquisa.on('input', function() {
            var searchTerm = $(this).val();
            $('#searchResults').show();

            filtrarPaciente(searchTerm);
        });

        campoPesquisa.on('blur', function() {
            $('#searchResults').empty().hide();
        });


        function filtrarPaciente(campo_pesquisa) {
            $.ajax({
                url: './controller/filtrar_paciente.php',
                method: 'POST',
                data: {
                    campo_pesquisa: campo_pesquisa
                },
                success: function(response) {
                    sugestaoFiltro(response);
                },
                error: function(xhr, status, error) {
                    console.error('Erro na busca de usuários:', error);
                }
            });
        }

        $('#buttonSearch').on('click', function() {
            var campoPesquisa = $('.search-bar').val();

            if (campoPesquisa.trim() !== '') {
                buscarInfoTableFiltro(campoPesquisa);
            } else {
                buscaInfoTable();
            }
        });

        function sugestaoFiltro(sugestoes) {
            var searchResultsList = $('#searchResults');
            searchResultsList.empty();

            Object.values(sugestoes).forEach(function(paciente) {
                var listItem = $('<li class="list-group-item"></li>');
                listItem.text(paciente.nome);

                listItem.click(function() {
                    $('.search-bar').val(paciente.nome);
                    searchResultsList.empty();
                });

                searchResultsList.append(listItem);
            });
        }

    });

    function buscarInfoTableFiltro(campoPesquisa) {
        $.ajax({
            url: '../SistemaAgendamento/buscar_pacientes.php',
            type: 'POST',
            data: {
                campoPesquisa: campoPesquisa
            },
            success: function(response) {
                if ($.isEmptyObject(response)) {
                    alert('Nenhum usuário encontrado.');
                } else {
                    createTable(response);
                }
            },
            error: function() {
                alert('Ocorreu um erro ao buscar usuários.');
            }
        });
    }

    function buscaInfoTable() {
        $.ajax({
            url: '../SistemaAgendamento/buscar_pacientes.php',
            success: function(response) {
                createTable(response);
            }
        });
    }

    function createTable(data) {
        const table = document.querySelector('.table-container table tbody');
        table.innerHTML = '';
        for (const key in data.response) {
            if (data.response.hasOwnProperty(key)) {
                const pacientes = data.response[key];
                const row = document.createElement('tr');

                row.classList.add('tr-profissional');



                row.innerHTML = `
                    <td style="vertical-align: middle;"></td>
                    
                    <td style="display: flex; align-items: center;">
                        <span class="iniciais">${pacientes.iniciais_nome}</span>
                        <span style="margin-top: 5px;">${pacientes.nome} <br/> ${pacientes.cpf} </span>
                    </td>
                    <td class="info-text" style="vertical-align: middle;">
                        <span class="td_telefone">${pacientes.telefone}</span>
                    </td>
                    <td style="vertical-align: middle;">${pacientes.email}</td>
                    
                    <td style="vertical-align: middle; text-align:center;">${pacientes.data_nascimento}</td>
                    <td class="icon" style="vertical-align: middle;">
                        <div class="icon-container">
                            <span><img src="img/icon_lapis.png" data-toggle="modal" data-target="#modalPaciente" onClick=buscarDadosEdicao("${key}")></span>
                            <span><img src="img/icon_lixeira.png" onclick="excluir('${pacientes.nome}', ${key})"></span>
                        </div>
                    </td>`;

                table.appendChild(row);
            }
        }
    }

    function cadastrarPaciente() {
        $('#form_paciente').on('submit', function(event) {
            event.preventDefault();

            let nome = $('#nomePac').val();
            let cpf = $('#cpfPac').val();
            let data_nascimento = $('#dataNascimentoPac').val();
            let telefone = $('#telefonePac').val();
            let email = $('#emailPac').val();
            let endereco = $('#enderecoPac').val();


            $.ajax({
                url: "./controller/cadastrarPaciente.php",
                method: "POST",
                dataType: 'json',
                data: {
                    nome: nome,
                    cpf: cpf,
                    data_nascimento: data_nascimento,
                    telefone: telefone,
                    email: email,
                    endereco: endereco
                },
                success: function(response) {

                    if (response && response.success) {
                        $('#modalPaciente').modal('hide');
                        document.getElementById('form_paciente').reset();
                        $('#mensagemDoModal').text(response.message);
                        $('.modal-title-response').text('Sucesso!!');
                        $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                        $('#modalResponse').modal('show');
                        $('#modalResponse .modal-footer .btn-primary').off('click').on('click', function() {

                            location.reload(true);
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

    function formatDate(data) {
        const partes = data.split('/');
        if (partes.length === 3) {
            // Reorganize as partes para o formato aaaa-mm-dd
            return `${partes[2]}-${partes[1]}-${partes[0]}`;
        }
        return data; // Retorne a data no formato original se não for possível formatar
    }


    function buscarDadosEdicao(id) {
        let id_paciente = id;

        $('#paciente-text').text('Editar');

        $('#BtnEditar').show();
        $('#BtnCadastro').hide();

        const url = "../SistemaAgendamento/buscar_pacientes.php";

        $.ajax({
            url: url,
            data: {
                id_paciente: id_paciente
            },
            success: function(response) {
                var data = response.response;
                const dataNasciemnto = formatDate(data.data_nascimento);

                $('#nomePac').val(data.nome);
                $('#cpfPac').val(data.cpf);
                $('#dataNascimentoPac').val(dataNasciemnto);
                $('#telefonePac').val(data.telefone);
                $('#emailPac').val(data.email);
                $('#enderecoPac').val(data.endereco);

                $('#modalPaciente').modal('show');

                $('#BtnEditar').on('click', function() {

                    const dadosAlterados = {
                        id_paciente: id_paciente,
                        nome: $('#nomePac').val(),
                        cpf: $('#cpfPac').val(),
                        data_nascimento: $('#dataNascimentoPac').val(),
                        telefone: $('#telefonePac').val(),
                        email: $('#emailPac').val(),
                        endereco: $('#enderecoPac').val()
                    };

                    editar(dadosAlterados);

                });
            }
        });
    }


    function editar(dados) {
        $('#form_paciente').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "./controller/editarPaciente.php",
                method: "POST",
                dataType: 'json',
                data: dados,
                success: function(response) {
                    if (response.success) {
                        $('#modalPaciente').modal('hide');
                        document.getElementById('form_paciente').reset();
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

    function excluir(den_paciente, id_paciente) {
        var den_paciente = den_paciente;
        var id_paciente = id_paciente;

        $('#modalExcluir').modal('show');
        $('#mensagemDeExclusao').html("Deseja excluir o cadastro do usuário <b>" + den_paciente + "</b> ?");

        $('#modalExcluir .modal-footer .btn-primary').on('click', function() {

            $('#modalExcluir').modal('hide');

            $.ajax({
                url: "./controller/excluirPaciente.php",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_paciente: id_paciente
                },
                success: function(response) {
                    if (response && response.success) {
                        $('#mensagemDoModal').text(response.message);
                        $('.modal-title-response').text('Feito!');
                        $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                        $('#modalResponse').modal('show');
                        $('#modalResponse .modal-footer .btn-primary').on('click', function() {
                            location.reload();
                        });
                    } else {
                        console.error('Erro ao excluir o usuário:', response.message);
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

        $('.add-paciente').on('click', function() {
            $('#paciente-text').text('Cadastrar');
            $('#BtnEditar').hide();
            $('#BtnCadastro').show();
            document.getElementById('form_paciente').reset();
        });

        $('#BntCadastroPaciente').on('click', function(event) {
            $('#form_paciente').on('submit', function(event) {
                event.preventDefault();
            });
        });

        $('.modal-cancelar-excluir').on('click', function(event) {
            document.getElementById('form_paciente').reset();
        });

        buscaInfoTable();
    });
</script>

</html>