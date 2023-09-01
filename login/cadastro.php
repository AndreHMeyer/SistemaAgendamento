<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
</head>

<body>
    
    <h3>Cadastro</h3>
    
    <form action="cadastrar.php" method="POST">
        <input name="nome" type="text" class="input is-large" placeholder="Nome" autofocus>
        <input name="email" type="text" class="input is-large" placeholder="Email">
        <input name="senha" class="input is-large" type="password" placeholder="Senha">
        <button type="submit" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
    </form>

</body>

</html>