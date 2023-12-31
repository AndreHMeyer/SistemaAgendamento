<?php
session_start();

if(isset($_SESSION['usuario'])) {
    header('Location: pagina_de_sucesso.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Remember Med</title>
    <link rel="stylesheet" href="includes/bootstrap-4.0.0/bootstrap-4.0.0/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="includes/icons-main/font/bootstrap-icons.css">
    <script src="includes/jquery-3.7.1.js"></script>
</head>
<style>
    body {
        background-image: url("img/imagem_login.jpeg");  /*Fundo da página com o a imagem*/
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center; /* Centraliza a imagem na página*/
        background-attachment: fixed; /* Fixa a imagem para que ela não role  */
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }


    .centered {
        border-radius: 10px;
        width: 400px;
        height: 420px;
        background-color: white;
        text-align: center;
    }

    h1 {
        color: #252EFF;
        margin-top: 30px;
        margin-bottom: 40px;
    }

    .label-name {
        width: 300px;
        margin-left: 10px;
        margin-right: 10px;
    }

    .campo-form {
        width: 360px;
        border-radius: 10px;
        border: #252EFF 1px solid;
        margin-left: 20px;
    }

    .btn-login {
        height: 40px;
        width: 300px;
        border-radius: 50px;
        border: #252EFF 1px solid;
        background-color: white;
        color: #252EFF;
    }
</style>

<body>
    <div class="container">
        <div class="centered">
            <form>
                <h1><b>Login</b></h1>
                <div class="form-outline mb-4">
                    <input type="text" id="email" class="form-control campo-form" placeholder="Nome do Usuário" />
                    <div id="emailError" class="invalid-feedback d-none" style="margin-bottom: -10px;">
                        <i class="bi bi-exclamation-circle"></i>
                        <span id="userErrorMessage" style="margin-right:210px;"></span>
                    </div>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" id="senha" class="form-control campo-form" placeholder="Senha" />
                    <div id="senhaError" class="invalid-feedback d-none" style="margin-bottom: -10px;">
                        <i class="bi bi-exclamation-circle"></i>
                        <span id="senhaErrorMessage" style="margin-right:220px;"></span>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col">
                        <a href="#!">Esqueceu a senha?</a>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <button type="button" id="btnLogin"
                            class="btn btn-primary btn-block btn-login d-flex align-items-center justify-content-center">Fazer
                            Login</button>
                    </div>
                </div>

                <div class="text-danger" style=" display: none; font-size: 14px;">
                    <div id="emptyCampos">
                        <i class="bi bi-exclamation-circle"></i>
                        <span id="emptyErrorMessage"></span>
                    </div>
                </div>


            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {
        $("#btnLogin").click(function () {
            var email = $("#email").val();
            var senha = $("#senha").val();

            if (email === "" || senha === "") { // Verrifica se os campos estão vazios

                console.log("Campos vazios");
                $("#emptyCampos").parent().css("display", "block");
                $("#emptyErrorMessage").text("Por favor preencha todos os campos."); // Mensagem de erro

                if (email === "") {
                    $("#userErrorMessage").text("Usuário não informado."); // Messagem de erro 
                    $("#emailError").removeClass("d-none");
                    $("#email").addClass("is-invalid");
                }

                if (senha === "") {
                    $("#senhaErrorMessage").text("Senha não informada."); // Mensagem de erro
                    $("#senhaError").removeClass("d-none");
                    $("#senha").addClass("is-invalid");
                }

                return; // Impede o envio do formulário se os campos estiverem vazios

            } else {

                var data = {
                    email: email,
                    senha: senha
                };

                $.ajax({
                    type: "POST",
                    url: "./controller/autenticacao.php",
                    dataType: "json",
                    data: JSON.stringify(data),

                    success: function (response) {

                        if (response.result === 'success') { // Caso seja validado corretamente, envia o usuário para a tela inicial do sistema
                            window.location.href = 'pagina_de_sucesso.php';
                        } else if (response.result === 'failed') { // Caso a senha esteja incorreta, mostra ao usuário
                            $("#senhaErrorMessage").text("Senha incorreta"); // Mensagem de erro
                            $("#senhaError").removeClass("d-none");
                            $("#senha").addClass("is-invalid"); // Elemento para indicar campo como inválido
                        } else {
                            // Exibir informações de erro mais detalhadas
                            console.error('Erro desconhecido:', response.error); // Log do erro no console
                            alert('Erro desconhecido. Detalhes: ' + response.error); // Exibir mensagem de erro ao usuário
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Log do erro no console
                        alert('Erro de comunicação com o servidor. Detalhes: ' + error); // Exibir mensagem de erro ao usuário
                    }
                });

            }
        });
    });


</script>
</html>
