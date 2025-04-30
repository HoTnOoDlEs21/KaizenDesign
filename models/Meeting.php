<?php

class Meeting
{

    public $id;
    public $data;
    public $hora;
    public $observacoes;
    public $utilizador_id;

    public function __construct($id, $data, $hora, $observacoes, $utilizador_id)
    {
        $this->id = $id;
        $this->data = $data;
        $this->hora = $hora;
        $this->observacoes = $observacoes;
        $this->utilizador_id = $utilizador_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->data;
    }

    public function getTime()
    {
        return $this->hora;
    }

    public function getObservations()
    {
        return $this->observacoes;
    }

    public function getUserId()
    {
        return $this->utilizador_id;
    }
}
