<?php

use app\DAO;
use app\Livro;
use app\Cliente;
use app\Aluguel;

#Global definitions
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
#Getting information from JSON
$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

#Get function to use
$objeto = $obj["objeto"];
$funcao = $obj["funcao"];

#Conect into DataBase
require_once "app/DAO.php";
$con = new DAO('127.0.0.1', 'biblioteca', 'utf8mb4', 'root', '');
$pdo = new PDO($con->getDns(), $con->getUser(), $con->getPassword());

if ($objeto == 'Cliente'){
    require_once "app/Cliente.php";
    #Checking function
    if ($funcao == 'cadastra'){
        $nome = $obj["nome"];
        $autor = $obj["idade"];
        $genero = $obj["cpf"];
        $cliente = new Cliente($nome, $autor, $genero);
        $cliente->cadastra($pdo);
    }
    elseif ($funcao == 'altera'){
        $nome = $obj["nome"];
        $idade = $obj["idade"];
        $cpf = $obj["cpf"];
        $id_cliente = $obj["id_cliente"];
        $cliente = new Cliente($nome, $idade, $cpf, $id_cliente);
        $cliente->altera($pdo);
    }
    elseif ($funcao == 'deleta'){
        $id_cliente = $obj["id_cliente"];
        $cliente = new Cliente("","","",$id_cliente);
        $cliente->deleta($pdo);
    }
}
elseif ($objeto == 'Livro'){
    require_once "app/Livro.php";
    #Checking function
    if ($funcao == 'cadastra'){
        $nome = $obj["nome"];
        $autor = $obj["autor"];
        $genero = $obj["genero"];
        $livro = new Livro($nome, $autor, $genero);
        $livro->cadastra($pdo);
    }
    elseif ($funcao == 'altera'){
        $nome = $obj["nome"];
        $autor = $obj["autor"];
        $genero = $obj["genero"];
        $id_livro = $obj["id_livro"];
        $livro = new Livro($nome, $autor, $genero, $id_livro);
        $livro->altera($pdo);
    }
    elseif ($funcao == 'deleta'){
        $id_livro = $obj["id_livro"];
        $livro = new Livro("","","",$id_livro);
        $livro->deleta($pdo);
    }
}
elseif ($objeto == 'Aluguel'){
    require_once "app/Aluguel.php";
    $id_cliente = $obj["id_cliente"];
    $id_livro = $obj["id_livro"];
    #Checking function
    if ($funcao == 'aluga'){
        $dia_aluguel = $obj["dia_aluguel"];
        $aluguel = new Aluguel($id_cliente, $id_livro, $dia_aluguel, "");
        $aluguel->aluga($pdo);
    }
    elseif ($funcao == 'adiaDevolucao'){
        $dia_devolucao = $obj["dia_devolucao"];
        $aluguel = new Aluguel($id_cliente, $id_livro, "", $dia_devolucao);
        $aluguel->adiaDevolucao($pdo);
    }
}