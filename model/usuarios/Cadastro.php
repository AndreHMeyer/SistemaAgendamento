<?php

use Database\ConexaoDB;
require_once(__DIR__ . "\..\..\bancoDeDados\ConexaoDB.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Cadastro
{
    private $nomeUsuario;
    private $email;
    private $senha;
    private $conexao;

    public function __construct($nomeUsuario, $email, $senha)
    {
        $this->nomeUsuario = $nomeUsuario;
        $this->email = $email;
        $this->senha = $senha;
        $this->conexao = new ConexaoDB();
        $this->conexao = $this->conexao->criarConexao();
    }

    public function insertUsuario()
    {
        // Verifica se o email existe
        $email = mysqli_real_escape_string($this->conexao, trim($this->email));
        $sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = '$email'";
        $result = mysqli_query($this->conexao, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row['total'] >= 1) {
            $_SESSION['email_existe'] = true;
            header('Location: cadastro.php');
            exit;
        }

        // Hash da senha
        $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nomeUsuario, email, senha) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $this->nomeUsuario, $this->email, $senhaHash);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status_cadastro'] = true;
            $_SESSION['cadastro_sucesso'] = true;
        } else {
            $_SESSION['status_cadastro'] = false;
            echo "Erro ao cadastrar: " . mysqli_error($this->conexao);
        }        

        mysqli_stmt_close($stmt);

        header('Location: cadastro.php');
        exit;
    }
}
?>
