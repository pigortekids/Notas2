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

}