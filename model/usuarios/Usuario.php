<?php

namespace Usuario;

use Database\ConexaoDB;
use Database\RepositorioUsario;
use mysqli;

require_once(__DIR__ . "\..\..\bancoDeDados\ConexaoDB.php");

class Usuario
{
    private $id;
    private $nomeUsuario;
    private $senhaHash;
    private $email;

    /**
     * @param $id
     * @param $nomeUsuario
     * @param $senhaHash
     * @param $email
     */
    public function __construct($id, $nomeUsuario, $senhaHash, $email)
    {
        $this->id = $id;
        $this->nomeUsuario = $nomeUsuario;
        $this->senhaHash = $senhaHash;
        $this->email = $email;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getNomeUsuario(): string
    {
        return $this->nomeUsuario;
    }

    public function getSenha(): string
    {
        return $this->senhaHash;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNomeUsuario(string $nomeUsuario): void
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function setSenha(string $senha): void
    {
        $this->senhaHash = $senha;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }



}


?>