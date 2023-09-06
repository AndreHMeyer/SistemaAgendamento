<?php

use Database\ConexaoDB;
require_once(__DIR__ . "\..\..\bancoDeDados\ConexaoDB.php");

class Login
{
    private $email;
    private $senha;
    private $conexao;

    /**
     * @param $nomeUsuario
     * @param $senha
     */
    public function __construct($email, $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
        $this->conexao = new ConexaoDB();
        $this->conexao = $this->conexao->criarConexao();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }



    public function autenticar()
    {
        $conexao = $this->conexao;
        $email = mysqli_real_escape_string($conexao, $this->getEmail());
        $senha = mysqli_real_escape_string($conexao, $this->getSenha());

        $query = "select email, senha from usuario where email = '{$email}' and senha = '{$senha}'";

        $result = mysqli_query($conexao, $query);

        $row = mysqli_num_rows($result);

        if($row == 1) {
            echo 'autenticado';
            return true;
        } else {
           echo 'nao autenticado';
           return false;
        }

    }


}