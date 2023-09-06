<?php

class Usuario
{
    private $id;
    private $nomeUsuario;
    private $senha;
    private $email;
    private $idPessoa;

    /**
     * @param $id
     * @param $nomeUsuario
     * @param $senha
     * @param $email
     * @param $idPessoa
     */
    public function __construct($id, $nomeUsuario, $senha, $email, $idPessoa)
    {
        $this->id = $id;
        $this->nomeUsuario = $nomeUsuario;
        $this->senha = $senha;
        $this->email = $email;
        $this->idPessoa = $idPessoa;
    }




}