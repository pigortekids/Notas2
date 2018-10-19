<?php

namespace app;

use app\DAO;

class Celular implements \JsonSerializable{

    private $nome;
    private $fabricante;
    private $aVista;
    private $semJuros;
    private $semJurosTotal;
    private $processador;
    private $tela;
    private $peso;
    private $bateria;
    private $memoria;
    private $ram;

    public function selecionaTudo(){

        #Creating query
        $query = "SELECT * FROM tbl_celulares";

        try 
            {
            require_once "DAO.php";
            $conexao = new DAO();
            $stmt = $conexao->con->prepare($query);

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
                $jaison = $jaison."\"nome\":\"".$row['nome']."\"}";
                $contador += 1;
            }
            $jaison = $jaison."]";

            return $jaison;

            http_response_code(201);

            }
        catch(PDOException $e)
            {
                return $query."<br>".$e->getMessage();
            }

    }

    public function selecionaPorNome($nome){

        #Creating query
        $query = "SELECT * FROM tbl_celulares WHERE (nome = :NOME);";

        try 
            {
            require_once "DAO.php";
            $conexao = new DAO();
            $stmt = $conexao->con->prepare($query);

            $stmt->bindParam(":NOME", $nome);

            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $this->nome = $row['nome'];
                $this->fabricante = $row['fabricante'];
                $this->aVista = "R$".number_format($row['aVista'], 2, ',', '.');
                $this->semJuros = "12x R$".number_format($row['semJuros'], 2, ',', '.');
                $this->semJurosTotal = "R$".number_format($row['semJurosTotal'], 2, ',', '.');
                $this->processador = $row['processador']."GHz";
                $this->tela = $row['tela']."´´";
                $this->peso = $row['peso']."g";
                $this->bateria = $row['bateria']."h 3G";
                $this->memoria = $row['memoria']."G";
                $this->ram = $row['ram']."G";
            }

            http_response_code(201);

            }
        catch(PDOException $e)
            {
                return $query."<br>".$e->getMessage();
            }

    }

    public function jsonSerialize()
    {
        return array( 'nome' => $this->nome,
                        'fabricante' => $this->fabricante,
                        'aVista' => $this->aVista,
                        'semJuros' => $this->semJuros,
                        'semJurosTotal' => $this->semJurosTotal,
                        'processador' => $this->processador,
                        'tela' => $this->tela,
                        'peso' => $this->peso,
                        'bateria' => $this->bateria,
                        'memoria' => $this->memoria,
                        'ram' => $this->ram);
    }

}