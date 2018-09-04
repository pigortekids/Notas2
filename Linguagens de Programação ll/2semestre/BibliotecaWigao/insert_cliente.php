<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');


$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

$cpf = $obj["cpf"];
$nome = $obj["nome"];
$idade = $obj["idade"];

$host = '127.0.0.1:3307';
$db   = 'biblioteca';
$user = 'root'; 
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try 
    {
    $pdo = new PDO($dsn, $user, $pass);

    $stmt = $pdo->prepare("INSERT INTO tbl_cliente (cpf, nome, idade) VALUES (:CPF, :NOME, :IDADE)");

    $stmt->bindParam(":CPF", $cpf);
    $stmt->bindParam(":NOME", $nome);
    $stmt->bindParam(":IDADE", $idade);

    $stmt->execute();

    http_response_code(201);

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }