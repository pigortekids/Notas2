<?php

namespace app\model;

use app\classes\Cliente;
use app\model\DAO;

class ClienteDAO
{
    
    public function getCliente( $id_cliente )
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
    
    public function createCliente( Cliente $cliente )
    {
        # Pode lançar erro
        $connDB = new DAO();
        $stmt = $connDB->con->prepare("INSERT INTO tbl_cliente (nome, idade, cpf) VALUES (:NOME, :IDADE, :CPF)");

        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":IDADE", $idade);
        $stmt->bindParam(":CPF", $cpf);

        $nome = $cliente->getNome();
        $idade = $cliente->getIdade();
        $cpf = $cliente->getCPF();
        $stmt->execute();
    }

}