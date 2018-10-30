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

    public function aluga($pdo, $nome){

        #Creating query
        $query = "INSERT INTO tbl_aluguel SELECT tbl_cliente.id_cliente, :ID_LIVRO, :ALUGUEL, :DEVOLUCAO FROM tbl_cliente WHERE tbl_cliente.nome LIKE '%".$nome."%'";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":ID_LIVRO", $this->id_livro);
            $data_aluguel = date("Y-m-d");
            $data_devolucao = date('Y-m-d', strtotime($data_aluguel. ' + 1 week'));
            $stmt->bindParam(":ALUGUEL", date("d/m/Y"));
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