<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>

<body>
    
    <?php
    if(isset($_SESSION['nao_autenticado'])):
    ?>
        <p>ERRO: Usuário ou senha inválidos.</p>
    <?php
    endif;
    unset($_SESSION['nao_autenticado']);
    ?>
    <form action="login.php" method="POST">
        <input name="email" name="text" class="input is-large" placeholder="E-mail" autofocus="">
        <input name="senha" class="input is-large" type="password" placeholder="Senha">
        <a href="cadastro.php">Cadastrar</a>
        <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
    </form>

</body>

</html>