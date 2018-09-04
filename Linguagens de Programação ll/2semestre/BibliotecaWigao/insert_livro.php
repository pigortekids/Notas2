<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');


$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

$nome = $obj["nome"];
$autor = $obj["autor"];
$genero = $obj["genero"];

$host = '127.0.0.1:3307';
$db   = 'biblioteca';
$user = 'root'; 
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try 
    {
    $pdo = new PDO($dsn, $user, $pass);

    $stmt = $pdo->prepare("INSERT INTO tbl_livro (nome, autor, genero) VALUES (:NOME, :AUTOR, :CLIENTE)");

    $stmt->bindParam(":NOME", $nome);
    $stmt->bindParam(":AUTOR", $autor);
    $stmt->bindParam(":CLIENTE", $genero);

    $stmt->execute();

    http_response_code(201);

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }