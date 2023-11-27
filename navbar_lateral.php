

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" href="img/logo.png"> -->
    <title>Remember Med</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_navbar.css">
</head>

<body>
    <div class="d-flex flex-column flex-shrink-0" id="sidebar">
        <nav class="navbar navbar-dark">
            <div class="container-fluid" style="margin-left: -15px;">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="toggleSidebar">
                    <div class="navbar">
                        <div class="animated-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </button>
            </div>
        </nav>
        <ul class="nav nav-pills nav-flush flex-column mb-auto">
            <li class="nav-item">
                <a href="pacientes.php" class="nav-link " title="Pacientes">
                    <img width="35" src="img/user_icon.png" alt="Icone de Usuário">
                    <span class="item-name">Pacientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profissionais.php" class="nav-link" title="Profissionais">
                    <!-- data-toggle="modal" data-target="#profissional"!-->
                    <img width="35" src="img/doctor_user.png" alt="Icone de Profissionais">
                    <span class="item-name">Profissionais</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="agendas.php" class="nav-link " title="Agenda">
                    <img width="35" src="img/agenda_icon.png" alt="Icone de Agenda">
                    <span class="item-name">Agendas</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="usuarios.php" class="nav-link " title="Usuários">
                    <img width="35" src="img/settings_icon.png" alt="Icone de Usuários">
                    <span class="item-name">Usuários</span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="modal fade" id="profissional">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Profissional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formProfissional">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control col-sm-12" id="nome" placeholder="Nome Sobrenome" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" placeholder="123.456.789-10" required>
                                </div>
                                <div class="col">
                                    <label for="dataNascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="dataNascimento" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" placeholder="(99)9 9999-1234" required>
                                </div>
                                <div class="col">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" placeholder="nome@email.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="num_conselho">No. Conselho</label>
                                    <input type="text" class="form-control" id="num_conselho" placeholder="12345" required>
                                </div>
                                <div class="col">
                                    <label for="conselho">Conselho</label>
                                    <input type="text" class="form-control" id="conselho" placeholder="CRM" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" class="form-control" id="endereco" placeholder="Rua 123, número 456" required>
                                </div>
                                <!-- <div class="col">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" id="cep" placeholder="00000-000" required>
                                </div> -->
                            </div>
                        </div>
                        <button type="button" class="btn btn-link" style="margin-top: 5px;float: left; color: red;">Excluir</button>
                        <button type="submit" class="btn btn-primary" id="BtnCadastroProfissional" style="margin-top: 5px;float: right">Salvar</button>
                        <button type="button" class="btn btn-link" style="margin-top: 5px;float: right; color: red; margin-right: 30px;">Cancelar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            /*Não quero que esses elementos sejam sobescritos, portanto irei usar const para declarara essas variaveis*/
            const $sidebar = $("#sidebar");
            const $toggleSidebarButton = $("#toggleSidebar");
            $(".animated-icon").click(function() {
                $(this).toggleClass("open");
            });
            // Adicionando ouvinte de eventos, que vai alterar a largura da barra lateral e o ícone 
            $toggleSidebarButton.click(function(e) {
                e.stopPropagation(); // Impede que o evento de clique se interfira em outras partes do documento
                $sidebar.toggleClass("expanded");
            });
            // Ouvinte de eventos para fechar a navbar, caso o usuário clique em outra parte da página que não seja a navbar
            $(document).click(function(e) {
                if (!$sidebar.is(e.target) && $sidebar.has(e.target).length === 0) {
                    $sidebar.removeClass("expanded");
                }
            });
            $('#formCliente').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'controller/cadastrarPessoa.php', // o arquivo PHP que irá processar os dados
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#paciente').modal('hide');
                    }
                });
                alert('Cliente cadastrado/atualizado.');
            });
            $('#formProfissional').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'controller/cadastrarProfissional.php', // o arquivo PHP que irá processar os dados
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#profissional').modal('hide');
                    }
                });
                alert('Profissional cadastrado/atualizado.');
            });
            $('#formConsulta').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'controller/cadastrarConsulta.php', // o arquivo PHP que irá processar os dados
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#consulta').modal('hide');
                    }
                });
                alert('Consulta cadastrada.');
            });
        });
    </script>
</body>

</html>