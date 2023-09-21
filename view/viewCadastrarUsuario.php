<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="../controller/cadastrarUsuario.php" method="post">
        <label for="nomeUsuario">Nome de Usuário:</label>
        <input type="text" id="nomeUsuario" name="nomeUsuario" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="confirmaSenha">Confirme a Senha:</label>
        <input type="password" id="confirmaSenha" name="confirmaSenha" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
