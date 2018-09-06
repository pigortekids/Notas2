<?php
#Global definitions
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

#Getting information from JSON
$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

#Setting up variables
$id_cleinte = $obj["id_cliente"];
$id_livro = $obj["id_livro"];
$dia_devolucao = $obj["dia_devolucao"];

#Creating query
$query = "UPDATE tbl_aluguel SET (dia_devolucao = :DIA_DEVOLUCAO) WHERE (id_cliente = :ID_CLIENTE AND id_livro = :ID_LIVRO);";

#Setting up connection
$host = '127.0.0.1:3307';
$db   = 'biblioteca';
$user = 'root'; 
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try 
    {
    $pdo = new PDO($dsn, $user, $pass);

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":ID_CLIENTE", $id_cliente);
    $stmt->bindParam(":ID_LIVRO", $id_livro);
    $stmt->bindParam(":DIA_DEVOLUCAO", $dia_devolucao);

    $stmt->execute();

    http_response_code(201);

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }