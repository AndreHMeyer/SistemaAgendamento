<?php

namespace Database;

use Usuario\Usuario;

require_once(__DIR__ . "..\..\model\usuarios\Usuario.php");

class RepositorioUsuario
{
    private $conexao;

    public function __construct()
    {
        $conexao = new ConexaoDB();
        $this->conexao = $conexao->criarConexao();
    }

    public function obterUsuarioById($id)
    {
        $conexao = $this->conexao;

        $idParam = mysqli_real_escape_string($conexao, $id);

        $sql = "SELECT * FROM usuario WHERE ID = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $idParam);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);

            $usuario = new Usuario(
                $row['id'],
                $row['nomeUsuario'],
                $row['senha'],
                $row['email'],
            );

            return $usuario;
        } else {
            throw new \Exception('Usuário não localizado');
        }
    }

    public function obterTodosUsuarios()
    {
        $conexao = $this->conexao;

        $sql = "SELECT * FROM USUARIO ORDER BY ID";
        $result = mysqli_query($conexao, $sql);

        if ($result->num_rows > 0) {
            $usuarios = []; // Use a different variable name

            while ($row = $result->fetch_assoc()) {
                $usuarios[] = new Usuario(
                    $row['id'],
                    $row['nomeUsuario'],
                    $row['senha'],
                    $row['email']
                ); // Close the parenthesis properly
            }

            return $usuarios;
        }
        return false;
    }

    public function insertUsuario($usuario)
    {
        // Verifica se o email existe
        $email = mysqli_real_escape_string($this->conexao, trim($usuario->getEmail()));
        $sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = ?";
        $stmt = mysqli_prepare($this->conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row['total'] >= 1) {
            $_SESSION['email_existe'] = true;
            header('Location: Cadastro.php');
            exit;
        }

        // Hash da senha
        $senhaHash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nomeUsuario, email, senha) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $usuario->getNomeUsuario(), $email, $senhaHash);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status_cadastro'] = true;
            $_SESSION['cadastro_sucesso'] = true;
        } else {
            $_SESSION['status_cadastro'] = false;
            throw new \Exception("Erro ao cadastrar: " . mysqli_error($this->conexao));
        }

        mysqli_stmt_close($stmt);

        header('Location: ..\model\usuarios\Cadastro.php');
        exit;
    }

    public function updateUsuario($usuario)
{
    $conexao = $this->conexao;

    $id = mysqli_real_escape_string($conexao, $usuario->getId());
    $nomeUsuario = mysqli_real_escape_string($conexao, $usuario->getNomeUsuario());
    $email = mysqli_real_escape_string($conexao, $usuario->getEmail());
    $senha = mysqli_real_escape_string($conexao, $usuario->getSenha());

    $selectSQL = "SELECT COUNT(1) AS TOTAL FROM USUARIO WHERE id = ?";
    $stmt = $conexao->prepare($selectSQL);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['TOTAL'] >= 1) {
        $updateSQL = "UPDATE USUARIO SET 
              nomeUsuario = ?,
              email = ?,
              senha = ?
              WHERE id = ?";

        $stmt = $conexao->prepare($updateSQL);
        $stmt->bind_param('ssss', $nomeUsuario, $email, $senha, $id);

        if ($stmt->execute()) {
            echo 'Usuário atualizado com sucesso!' . PHP_EOL;
            return true;
        } else {
            echo 'Houve um erro ao atualizar o cadastro do usuário' . PHP_EOL;
            return false;
        }
    } else {
        echo 'Usuário não encontrado!' . PHP_EOL;
        return false;
    }
}

    public function deleteUsuario($usuario)
    {
        $conexao = $this->conexao;

        $id = $usuario->getId();

        $deleteSQL = "DELETE FROM USUARIO WHERE id = ?";
        $stmt = $conexao->prepare($deleteSQL);
        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            echo 'Usuário excluído com sucesso!';
            return true;
        } else {
            echo 'Houve um erro ao excluir o usuário.';
            return false;
        }
    }


}

?>