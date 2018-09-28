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

    public function procura($pdo){
        #Creating query
        $query = "SELECT tbl_livro.nome, tbl_aluguel.dia_aluguel, tbl_aluguel.dia_devolucao FROM tbl_aluguel, tbl_livro, tbl_cliente WHERE (tbl_cliente.nome LIKE '%".$this->nome."%' AND tbl_aluguel.id_cliente = tbl_cliente.id_cliente AND tbl_livro.id_livro = tbl_aluguel.id_livro)";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":NOME", $this->nome);

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
                $jaison = $jaison."\"nome\":\"".$row['nome']."\",";
                $jaison = $jaison."\"dia_aluguel\":\"".$row['dia_aluguel']."\",";
                $jaison = $jaison."\"dia_devolucao\":\"".$row['dia_devolucao'];
                $jaison = $jaison."}";
                $contador += 1;
            }
            $jaison = $jaison."]";
            echo $jaison;

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