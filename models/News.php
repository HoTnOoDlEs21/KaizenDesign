<?php

class News
{

    public $id;
    public $titulo;
    public $imagem;
    public $conteudo;
    public $data_publicacao;

    public function __construct($id, $titulo, $conteudo, $imagem, $data_publicacao)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
        $this->imagem = $imagem;
        $this->data_publicacao = $data_publicacao;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->titulo;
    }

    public function getContent()
    {
        return $this->conteudo;
    }

    public function getImage()
    {
        return $this->imagem;
    }

    public function getPublishDate()
    {
        return $this->data_publicacao;
    }
}
