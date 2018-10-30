<?php

namespace app\model;

use app\classes\Livro;
use app\model\DAO;

class LivroDAO
{

    public function getLivros()
    {
        # Pode lançar erro
        $conn = new DAO();
        $stmt = $conn->con->prepare("SELECT * FROM tbl_livro");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $arrayLivros = null;
        if ( $stmt->rowCount() > 0 ) {
            $arrayLivros = array();
            foreach ($result as $row) {
                $livroTemp = new Livro( $row );
                array_push($arrayLivros, $livroTemp->getLivro());
            }            
        }

        //print_r($arrayLivros);
        return $arrayLivros;
    }

    /*
    public function getLivro( $idLivro )
    {
        # Pode lançar erro
        $connDB = new DAO();
        $stmt = $connDB->con->prepare("SELECT * FROM tbl_livro where id_livro = :IDLIVRO");
        $stmt->bindParam(":IDLIVRO", $idLivro);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $livroTemp = null;
        if ( $stmt->rowCount() > 0 ) {
            $livroTemp = new Livro( $result[0] );
        };

        return $livroTemp;
    }

    public function createBolo( Bolo $boloInstancia )
    {
        # Pode lançar erro
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("INSERT INTO tbl_bolos (nome, sabor, cobertura, descricao) VALUES (:NOME, :SABOR, :COBERTURA, :DESCRICAO)");

        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":SABOR", $sabor);
        $stmt->bindParam(":COBERTURA", $cobertura);
        $stmt->bindParam(":DESCRICAO", $desc);

        $nome = $boloInstancia->getNome();
        $sabor = $boloInstancia->getSabor();
        $cobertura = $boloInstancia->getCobertura();
        $desc = $boloInstancia->getDescricao();
        $stmt->execute();
    }

    public function deleteBoloById( $idBolo ):bool
    {
        # Pode lançar erro
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("DELETE FROM tbl_bolos where id_bolo = :IDBOLO");
        $stmt->bindParam(":IDBOLO", $idBolo);

        # TRUE: sucesso
        # FALSE: Não existe registro com tal id_bolo
        $stmt->execute();
        return ( $stmt->rowCount() >= 1 );

    }

    public function updateBoloById( $idBolo, Bolo $boloInstancia ):bool
    {
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("UPDATE tbl_bolos SET nome = :NOME, sabor = :SABOR, cobertura = :COBERTURA, descricao =:DESCRICAO
                                    WHERE id_bolo = $idBolo");

        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":SABOR", $sabor);
        $stmt->bindParam(":COBERTURA", $cobertura);
        $stmt->bindParam(":DESCRICAO", $desc);

        $nome = $boloInstancia->getNome();
        $sabor = $boloInstancia->getSabor();
        $cobertura = $boloInstancia->getCobertura();
        $desc = $boloInstancia->getDescricao();
        # TRUE: sucesso
        # FALSE: Não existe registro com tal id_bolo
        $stmt->execute();
        return ( $stmt->rowCount() >= 1 );        
    }
    */
}