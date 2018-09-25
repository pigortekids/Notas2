<?php

namespace app;

class Livro{

    private $id_livro;
    private $nome;
    private $autor;
    private $genero;

    public function __construct($nome, $autor, $genero, $id_livro = 0){
        $this->id_livro = $id_livro;
        $this->nome = $nome;
        $this->autor = $autor;
        $this->genero = $genero;
    }

    public function cadastra($pdo){

        #Creating query
        $query = "INSERT INTO tbl_livro (nome, autor, genero) VALUES (:NOME, :AUTOR, :GENERO)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":NOME", $this->nome);
            $stmt->bindParam(":AUTOR", $this->autor);
            $stmt->bindParam(":GENERO", $this->genero);

            $stmt->execute();

            http_response_code(201);

            }
        catch(PDOException $e)
            {
            echo $query."<br>".$e->getMessage();
            }

    }

    public function altera($pdo){
        #Creating query
        $query = "UPDATE tbl_livro SET nome = :NOME, autor = :AUTOR, genero = :GENERO WHERE (id_livro = :ID);";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":NOME", $this->nome);
            $stmt->bindParam(":AUTOR", $this->autor);
            $stmt->bindParam(":GENERO", $this->genero);
            $stmt->bindParam(":ID", $this->id_livro);

            $stmt->execute();

            http_response_code(201);

            }
        catch(PDOException $e)
            {
            echo $query."<br>".$e->getMessage();
            }
    }

    public function deleta($pdo){

        #Creating query
        $query = "DELETE FROM tbl_livro WHERE (id_livro = :ID)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":ID", $this->id_livro);

            $stmt->execute();

            http_response_code(201);

            }
        catch(PDOException $e)
            {
            echo $query."<br>".$e->getMessage();
            }

    }

    public function deleta($pdo){

        #Creating query
        $query = "SELECT nome, autor, genero FROM tbl_livro";
        https://www.w3schools.com/Php/php_mysql_select.asp
        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":ID", $this->id_livro);

            $stmt->execute();

            http_response_code(201);

            }
        catch(PDOException $e)
            {
            echo $query."<br>".$e->getMessage();
            }

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