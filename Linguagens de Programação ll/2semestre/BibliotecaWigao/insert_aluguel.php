<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');


$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

$id_cleinte = $obj["id_cliente"];
$id_livro = $obj["id_livro"];
$dia_aluguel = $obj["dia_aluguel"];
$dia_devolucao = $obj["dia_devolucao"];

$host = '127.0.0.1:3307';
$db   = 'biblioteca';
$user = 'root'; 
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try 
    {
    $pdo = new PDO($dsn, $user, $pass);
    $query = 'INSERT INTO tbl_aluguel(id_cliente, id_livro, dia_aluguel, dia_devolucao) VALUES (:ID_CLIENTE, :ID_LIVRO, FROM_UNIXTIME(:DIA_ALUGUEL), FROM_UNIXTIME(:DIA_DEVOLUCAO));';
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":ID_CLIENTE", $id_cleinte);
    $stmt->bindParam(":ID_LIVRO", $id_livro);
    $stmt->bindParam(":DIA_ALUGUEL", $dia_aluguel);
    $stmt->bindParam(":DIA_DEVOLUCAO", $dia_devolucao);

    $stmt->execute();

    http_response_code(201);

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }