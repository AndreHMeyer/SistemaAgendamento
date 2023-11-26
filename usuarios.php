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

    .add-usuario {
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
        <h2 class="title" style="font-weight: bold;">Usuários</h2>
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
        <button class="btn add-usuario" type="button" onclick="abrirModal();"> +
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
                    <th scope="col" class="sortable" style="text-align:center;">Data Última Consulta</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody style="height: 50px;">

            </tbody>
        </table>
    </div>

    <div id="modalUsuario" class="modal fade" aria-labelledby="modalUsuario">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="img/person_icon.png" id="profissional-image" class="ml-2" width="30px;"> <span id="usuario-text"></span> Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_usuario">
                        <div class="form-group">
                            <label for="nomeUser">Nome</label>
                            <input type="text" class="form-control col-sm-12" id="nomeUser" name="nomeUser" placeholder="Nome Sobrenome" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" id="telefoneUser" name="telefoneUser" placeholder="(99)9 9999-1234" required>
                                </div>
                                <div class="col">
                                    <label for="emailUser">E-mail</label>
                                    <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="nome@email.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col" id="senha_um">
                                    <label for="senhaUser">Senha</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="senhaUser" name="senhaUser" placeholder="exempl@Senha123" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" style="color: #989898; border-color: #BEBEBE;" type="button" id="mostrarSenhaUser">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="senhaError" class="text-danger"></div>
                                </div>
                                <div class="col" style="margin-bottom: 30px;" id="senha_dois">
                                    <label for="rep_senhaUser">Repita a Senha</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="rep_senhaUser" name="rep_senhaUser" placeholder="exempl@Senha123" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" style="color: #989898; border-color: #BEBEBE;" type="button" id="mostrarRepSenha">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn modal-cancelar-excluir" style="margin-top: 5px;float: left; color: red;" data-dismiss="modal">Excluir</button>
                            <button type="submit" class="btn btn-primary" id="BtnCadastro" onclick="cadastrarUsuario();" style="margin-top: 5px;float: right">Salvar</button>
                            <button type="submit" class="btn btn-primary" id="BtnEditar" style="margin-top: 5px;float: right">Salvar</button>
                            <button type="button" class="btn modal-cancelar-excluir" style="margin-top: 5px;float: right; color: red; margin-right: 30px;" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
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
        $('#modalUsuario').modal('show')
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

            filtrarUsuario(searchTerm);
        });

        campoPesquisa.on('blur', function() {
            $('#searchResults').empty().hide();
        });


        function filtrarUsuario(campo_pesquisa) {
            $.ajax({
                url: './controller/filtrar_usuario.php',
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

            Object.values(sugestoes).forEach(function(usuario) {
                var listItem = $('<li class="list-group-item"></li>');
                listItem.text(usuario.nome);

                listItem.click(function() {
                    $('.search-bar').val(usuario.nome);
                    searchResultsList.empty();
                });

                searchResultsList.append(listItem);
            });
        }

    });

    function buscarInfoTableFiltro(campoPesquisa) {
        $.ajax({
            url: '../SistemaAgendamento/buscar_usuarios.php',
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
            url: '../SistemaAgendamento/buscar_usuarios.php',
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
                const usuarios = data.response[key];
                const row = document.createElement('tr');

                row.classList.add('tr-profissional');

                row.innerHTML = `
                    <td style="vertical-align: middle;"></td>
                    
                    <td style="display: flex; align-items: center;">
                        <span class="iniciais">${usuarios.iniciais_nome}</span>
                        <span style="margin-left: 10px;">${usuarios.nome}</span><br/>   
                    </td>
                    <td style="vertical-align: middle;">${usuarios.email}</td>
                    <td class="info-text" style="vertical-align: middle;">
                        <span class="td_telefone">${usuarios.telefone}</span>
                    </td>
                    <td style="vertical-align: middle; text-align:center;">${usuarios.ultima_consulta}</td>
                    <td class="icon" style="vertical-align: middle;">
                        <div class="icon-container">
                            <span><img src="img/icon_lapis.png" data-toggle="modal" data-target="#modalUsuario" onClick=buscarDadosEdicao("${key}")></span>
                            <span><img src="img/icon_lixeira.png" onclick="excluir('${usuarios.nome}', ${key})"></span>
                        </div>
                    </td>`;

                table.appendChild(row);
            }
        }
    }

    function cadastrarUsuario() {
        $('#form_usuario').on('submit', function(event) {
            event.preventDefault();

            var senha = $('#senhaUser').val();
            var repSenha = $('#rep_senhaUser').val();

            if (senha !== repSenha) {
                $('#senhaError').text('As senhas não coincidem.');
                $('#senhaUser, #rep_senhaUser').addClass('is-invalid');
            } else {
                $('#senhaError').text('');
                $('#senhaUser, #rep_senhaUser').removeClass('is-invalid');

                let nomeUsuario = $('#nomeUser').val();
                let telefone = $('#telefoneUser').val();
                let email = $('#emailUser').val();
                let senha = $('#senhaUser').val();


                $.ajax({
                    url: "./controller/cadastrarUsuario.php",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        nomeUsuario: nomeUsuario,
                        telefone: telefone,
                        email: email,
                        senha: senha
                    },
                    success: function(response) {

                        if (response && response.success) {
                            $('#modalUsuario').modal('hide');
                            document.getElementById('form_usuario').reset();
                            $('#mensagemDoModal').text(response.message);
                            $('.modal-title-response').text('Sucesso!!');
                            $('#iconeDoModal').html('<i class="bi bi-check-circle text-success"></i>');
                            $('#modalResponse').modal('show');
                            $('#modalResponse .modal-footer .btn-primary').on('click', function() {
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
            }
        });
    }


    function buscarDadosEdicao(id) {
        let id_usuario = id;

        $('#usuario-text').text('Editar');

        $('#BtnEditar').show();
        $('#BtnCadastro').hide();

        $('#senha_um, #senha_dois').hide();
        $('#senhaUser, #rep_senhaUser').prop('required', false);

        const url = "../SistemaAgendamento/buscar_usuarios.php";

        $.ajax({
            url: url,
            data: {
                id_usuario: id_usuario
            },
            success: function(response) {
                var data = response.response;

                $('#nomeUser').val(data.nome);
                $('#telefoneUser').val(data.telefone);
                $('#emailUser').val(data.email);

                $('#modalUsuario').modal('show');

                $('#BtnEditar').on('click', function() {

                    const dadosAlterados = {
                        id: id_usuario,
                        nome: $('#nomeUser').val(),
                        cpf: $('#cpfUser').val(),
                        data_nascimento: $('#dataNascimentoUser').val(),
                        telefone: $('#telefoneUser').val(),
                        email: $('#emailUser').val()
                    };

                    editar(dadosAlterados);

                });
            }
        });
    }


    function editar(dados) {
        $('#form_usuario').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "./controller/editarUsuario.php",
                method: "POST",
                dataType: 'json',
                data: dados,
                success: function(response) {
                    if (response.success) {
                        $('#modalUsuario').modal('hide');
                        document.getElementById('form_usuario').reset();
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

    function excluir(den_usuario, id_usuario) {
        var den_usuario = den_usuario;
        var id_usuario = id_usuario;

        $('#modalExcluir').modal('show');
        $('#mensagemDeExclusao').html("Deseja excluir o cadastro do usuário <b>" + den_usuario + "</b> ?");

        $('#modalExcluir .modal-footer .btn-primary').on('click', function() {

            $('#modalExcluir').modal('hide');

            $.ajax({
                url: "./controller/excluirUsuario.php",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_usuario: id_usuario
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

        $('.add-usuario').on('click', function() {
            $('#usuario-text').text('Cadastrar');
            $('#BtnEditar').hide();
            $('#BtnCadastro').show();
            $('#senha_um, #senha_dois').show();
            $('#senhaUser, #rep_senhaUser').prop('required', true);
            document.getElementById('form_usuario').reset();
        });

        $('#BtnCadastroUsuario').on('click', function(event) {
            $('#form_usuario').on('submit', function(event) {
                event.preventDefault();
            });
        });

        $('.modal-cancelar-excluir').on('click', function(event) {
            document.getElementById('form_usuario').reset();
        });

        buscaInfoTable();
    });
</script>

</html>