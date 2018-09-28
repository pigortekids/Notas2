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

    public function consulta($pdo){
        #Creating query
        $query = "SELECT * FROM tbl_livro";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->execute();

            $jaison = "[";
            $contador = 0;
            while ($row = $stmt->fetch()) {
                if ($contador == 0){
                    $jaison = $jaison."{";
                }
                else{
                    $jaison = $jaison.",{";
                }
                $jaison = $jaison."\"id_livro\":\"".$row['id_livro']."\",";
                $jaison = $jaison."\"nome\":\"".$row['nome']."\",";
                $jaison = $jaison."\"autor\":\"".$row['autor']."\",";
                $jaison = $jaison."\"genero\":\"".$row['genero']."\"";
                $jaison = $jaison."}";
                $contador += 1;
            }
            $jaison = $jaison."]";
            echo $jaison;

            http_response_code(200);

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