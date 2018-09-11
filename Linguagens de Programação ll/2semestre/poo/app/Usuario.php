<?php

namespace app;

class Usuario{

    private $cpf;
    private $nome;
    private $email;

    public function __construct($cpf, $nome, $email){
        $this->cpf;
        $this->nome;
        $this->email;
    }

    public function getCPF(){
        return $this->cpf;
    }
    public function setCPF($cpf){
        $this->cpf = $cpf;
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

}