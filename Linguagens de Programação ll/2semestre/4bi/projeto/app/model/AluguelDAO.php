<?php

namespace app\model;

use app\classes\Aluguel;
use app\model\DAO;

class AluguelDAO
{

    public function getAlugueis( $nome_cliente )
    {
        # Pode lançar erro
        $conn = new DAO();
        $stmt = $conn->con->prepare("SELECT tbl_livro.nome, tbl_aluguel.dia_aluguel, tbl_aluguel.dia_devolucao FROM tbl_aluguel, tbl_cliente, tbl_livro WHERE (tbl_cliente.nome LIKE '%".$nome_cliente."%' AND tbl_aluguel.id_cliente = tbl_cliente.id_cliente AND tbl_aluguel.id_livro = tbl_livro.id_livro)");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cadastraAluguel( $id_livro, $nome_cliente )
    {
        # Pode lançar erro
        $connDB = new DAO();
        $stmt = $connDB->con->prepare("INSERT INTO tbl_aluguel SELECT tbl_cliente.id_cliente, :ID_LIVRO, :ALUGUEL, :DEVOLUCAO FROM tbl_cliente WHERE tbl_cliente.nome LIKE '%".$nome_cliente."%'");

        $stmt->bindParam(":ID_LIVRO", $id_livro);
        $data_aluguel = date("Y-m-d");
        $data_devolucao = date('Y-m-d', strtotime($data_aluguel. ' + 1 week'));
        $stmt->bindParam(":ALUGUEL", $data_aluguel);
        $stmt->bindParam(":DEVOLUCAO", $data_devolucao);

        $stmt->execute();
    }

}