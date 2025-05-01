<?php

class Project
{

    public $id;
    public $titulo;
    public $imagem;
    public $descricao;
    public $tecnologia;
    public $tempo_gasto;

    public function __construct($id, $titulo, $imagem, $descricao, $tecnologia, $tempo_gasto)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->tecnologia = $tecnologia;
        $this->tempo_gasto = $tempo_gasto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->titulo;
    }

    public function getImage()
    {
        return $this->imagem;
    }

    public function getDescription()
    {
        return $this->descricao;
    }

    public function getTechnology()
    {
        return $this->tecnologia;
    }

    public function getTimeSpent()
    {
        return $this->tempo_gasto;
    }
}
