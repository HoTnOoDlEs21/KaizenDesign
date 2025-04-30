<?php

class User
{

    public $id;
    public $nome;
    public $apelido;
    public $dataNascimento;
    public $telefone;
    public $email;
    public $tipo;

    public function __construct($id, $nome, $apelido, $dataNascimento, $telefone, $email, $tipo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->dataNascimento = $dataNascimento;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->tipo = $tipo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->nome;
    }

    public function getLastName()
    {
        return $this->apelido;
    }

    public function getFullName()
    {
        return $this->nome . " " . $this->apelido;
    }

    public function getBirthday()
    {
        return $this->dataNascimento;
    }

    public function getBirthdayDMY()
    {
        return date('d-m-Y', strtotime($this->dataNascimento));
    }

    public function getPhone()
    {
        return $this->telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLevel()
    {
        return $this->tipo;
    }
}
