<?php

namespace app;

class Livro{

    private $nome;
    private $autor;
    private $genero;

    public function __construct($nome, $autor, $genero){
        $this->nome;
        $this->autor;
        $this->genero;
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getAutor(){
        return $this->autor;
    }
    public function setAutor($autor){
        $this->autor = $autor;
    }

    public function getGenero(){
        return $this->genero;
    }
    public function setGenero($genero){
        $this->genero = $genero;
    }

}