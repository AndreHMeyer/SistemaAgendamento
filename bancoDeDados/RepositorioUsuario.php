<?php

namespace Database;


use Usuario;
require_once ('model\usuarios\Usuario.php');
class RepositorioUsuario
{
    private $conexao;

    /**
     * @param $conexao
     */
    public function __construct()
    {
        $this->conexao = new ConexaoDB();
        $this->conexao = $this->conexao->criarConexao();
    }

    public function obterUsuarioById($id)
    {
        $conexao = $this->conexao;

        $idParam = mysqli_real_escape_string($conexao,$id);

        $sql = "SELECT * FROM USUARIO WHERE ID = '$idParam'";
        $result = mysqli_query($conexao, $sql);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);

            $usuario = new Usuario($row['id'],
                                    $row['nomeUsuario'],
                                    $row['senha'],
                                    $row['email'],
                                    $row['idPessoa']);

            return $usuario;
        } else {
            echo 'Usuário não localizado';
            return false; //Necessário lançar exceção
        }
    }

    public function obterTodosUsuarios()
    {

    }

    public function insertUsuario($usuario)
    {

    }

    public function updateUsuario($coluna, $valor, $idUsuario)
    {

    }

    public function deleteUsuario($usuario)
    {

    }


}