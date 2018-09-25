<?php

namespace app;

class Aluguel{

    private $id_cliente;
    private $id_livro;
    private $dia_aluguel;
    private $dia_devolucao;

    public function __construct($id_cliente, $id_livro, $dia_aluguel, $dia_devolucao){
        $this->id_cliente = $id_cliente;
        $this->id_livro = $id_livro;
        $this->dia_aluguel = $dia_aluguel;
        $this->dia_devolucao = $dia_devolucao;
    }

    public function aluga($pdo){

        #Creating query
        $query = "INSERT INTO tbl_aluguel (id_cliente, id_livro, dia_aluguel, dia_devolucao) VALUES (:CLIENTE, :LIVRO, :ALUGUEL, :DEVOLUCAO)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":CLIENTE", $this->id_cliente);
            $stmt->bindParam(":LIVRO", $this->id_livro);
            $stmt->bindParam(":ALUGUEL", $this->dia_aluguel);
            $stmt->bindParam(":DEVOLUCAO", $this->dia_devolucao);

            $stmt->execute();

            http_response_code(201);

            }
        catch(PDOException $e)
            {
            echo $query."<br>".$e->getMessage();
            }

    }

    public function adiaDevolucao($pdo){

        #Creating query
        $query = "UPDATE tbl_aluguel SET dia_devolucao = :DEVOLUCAO WHERE (id_cliente = :CLIENTE AND id_livro = :LIVRO)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":DEVOLUCAO", $this->dia_devolucao);
            $stmt->bindParam(":CLIENTE", $this->id_cliente);
            $stmt->bindParam(":LIVRO", $this->id_livro);

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

}