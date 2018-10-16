<?php

namespace app;

class Celular{

    private $id_celular;

    public function __construct($id_celular = 0){
        $this->id_celular = $id_celular;
    }

    public function selecionaTudo($pdo){

        #Creating query
        $query = "SELECT * FROM tbl_celulares";

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
                $jaison = $jaison."\"nome\":\"".$row['nome']."\",";
                $jaison = $jaison."\"fabricante\":\"".$row['fabricante']."\"";
                $jaison = $jaison."}";
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

    public function selecionaPorId($pdo){

        #Creating query
        $query = "SELECT * FROM tbl_celulares WHERE (id_celular = :ID);";

        try 
            {
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":ID", $this->id_celular);

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
                $jaison = $jaison."\"fabricante\":\"".$row['fabricante']."\"";
                $jaison = $jaison."}";
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

}