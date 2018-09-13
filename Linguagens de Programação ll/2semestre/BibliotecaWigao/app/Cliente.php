<?php

namespace app;

class Cliente{

    private $id_cliente;
    private $nome;
    private $idade;
    private $cpf;

    public function __construct($nome, $idade, $cpf, $id_cliente){
        $this->id_cliente = $id_cliente;
        $this->nome = $nome;
        $this->idade = $idade;
        $this->cpf = $cpf;
    }

    public function cadastra($pdo){

        #Creating query
        $query = "INSERT INTO tbl_cliente (nome, idade, cpf) VALUES (:NOME, :IDADE, :CPF)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":NOME", $this->nome);
            $stmt->bindParam(":IDADE", $this->idade);
            $stmt->bindParam(":CPF", $this->cpf);

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
        $query = "UPDATE tbl_cliente SET nome = :NOME, idade = :IDADE, cpf = :CPF WHERE (id_cliente = :ID);";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":NOME", $this->nome);
            $stmt->bindParam(":IDADE", $this->idade);
            $stmt->bindParam(":CPF", $this->cpf);
            $stmt->bindParam(":ID", $this->id_cliente);

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
        $query = "DELETE FROM tbl_cliente WHERE (id_cliente = :ID)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":ID", $this->id_cliente);

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

    public function getIdade(){
        return $this->idade;
    }
    public function setIdade($idade){
        $this->idade = $idade;
    }

    public function getCPF(){
        return $this->cpf;
    }
    public function setCPF($cpf){
        $this->cpf = $cpf;
    }

}