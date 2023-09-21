<?php

use Database\ConexaoDB;
use Database\RepositorioUsuario;
use Usuario\Usuario;

require_once("..\model\usuarios\Usuario.php");
require_once("..\bancoDeDados\RepositorioUsuario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUsuario = $_POST["nomeUsuario"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];

    $repo = new RepositorioUsuario();

    $novoUsuario = new Usuario($nomeUsuario, $senha, $email);

    $sucesso = $repo->insertUsuario($novoUsuario);

    if ($sucesso) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}

?>
