<?php

//Essa classe cria uma conexão com o banco de dados

namespace Database;

class ConexaoDB
{
    public function criarConexao() {

        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $db = 'sistemaagendamento';

        $conexao = mysqli_connect($host, $usuario, $senha, $db) or die ('Não foi possível conectar ao banco de dados');
        return $conexao;
    }




}