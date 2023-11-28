<?php

namespace Agenda;

class Agendamento
{
    private $tipoConsulta;
    private $dtInicio;
    private $dtFim;
    private $paciente;
    private $profissional;
    private $agenda;

    /**
     * @param $tipoConsulta
     * @param $dtInicio
     * @param $dtFim
     * @param $paciente
     * @param $profissional
     */
    public function __construct($tipoConsulta, $dtInicio, $dtFim, $paciente, $profissional)
    {
        $this->tipoConsulta = $tipoConsulta;
        $this->dtInicio = $dtInicio;
        $this->dtFim = $dtFim;
        $this->paciente = $paciente;
        $this->profissional = $profissional;
    }

    /**
     * @return mixed
     */
    public function getTipoConsulta()
    {
        return $this->tipoConsulta;
    }

    /**
     * @return mixed
     */
    public function getDtInicio()
    {
        return $this->dtInicio;
    }

    /**
     * @return mixed
     */
    public function getDtFim()
    {
        return $this->dtFim;
    }

    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @return mixed
     */
    public function getProfissional()
    {
        return $this->profissional;
    }

    /**
     * @return mixed
     */
    public function getAgenda()
    {
        return $this->agenda;
    }




}