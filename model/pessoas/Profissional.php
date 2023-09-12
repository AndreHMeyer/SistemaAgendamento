<?php

namespace Pessoa;

class Profissional extends Pessoa
{
    private $nrConselho;
    private $ufConselho;
    private $especialidade;

    /**
     * @param $nrConselho
     * @param $ufConselho
     * @param $especialidade
     */


    public function __construct($id, $nome, $cpf, $dataNascimento, $telefone, $email, $endereco, $nrConselho, $especialidade)
    {
        $this::setId($id);
        $this::setNome($nome);
        $this::setCpf($cpf);
        $this::setDataNascimento($dataNascimento);
        $this::setTelefone($telefone);
        $this::setEmail($email);
        $this::setEndereco($endereco);

        $this->nrConselho = $nrConselho;
        $this->especialidade = $especialidade;
    }

    /**
     * @return mixed
     */
    public function getNrConselho()
    {
        return $this->nrConselho;
    }

    /**
     * @param mixed $nrConselho
     */
    public function setNrConselho($nrConselho)
    {
        $this->nrConselho = $nrConselho;
    }



    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;
    }




}