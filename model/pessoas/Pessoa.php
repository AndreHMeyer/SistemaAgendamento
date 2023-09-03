<?php

namespace Pessoa;

use Database\ConexaoDB;
use Database\RepositorioPessoas;
use mysqli;

require_once(__DIR__ . "\..\..\bancoDeDados\ConexaoDB.php");

class Pessoa
{
    private $id;
    private $nome;
    private $email;
    private $cpf;
    private $dataNascimento;
    private $telefone;
    private $endereco;

    /**
     * @param $nome
     * @param $email
     * @param $cpf
     * @param $dataNascimento
     * @param $telefone
     */
    public function __construct($id, $nome, $email, $cpf, $dataNascimento, $telefone, $endereco)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->dataNascimento = $dataNascimento;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
}




}