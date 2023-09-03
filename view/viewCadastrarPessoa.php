<!--Responsável por criar o front-end da tela de cadastro de pessoas-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
</head>

<body>
<h1>Cadastro de Pessoa</h1>
<form action="../controller/cadastrarPessoa.php" method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required>
    <br>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="text" id="data_nascimento" name="data_nascimento" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>

    <label for="telefone">Telefone:</label>
    <input type="phone" id="telefone" name="telefone" required>
    <br>

    <label for="endereco">Endereco:</label>
    <input type="text" id="endereco" name="endereco" required>
    <br>

    <input type="submit" value="Cadastrar">

</form>
</body>

</html>