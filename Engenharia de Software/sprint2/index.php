<?php
#Global definitions
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
#Getting information from JSON
$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

#Conect into DataBase
require_once "app/DAO.php";
try {
    $con = new DAO('localhost', 'biblioteca', 'utf8mb4', 'root', '');
    $pdo = new PDO($con->getDns(), $con->getUser(), $con->getPassword());

    require_once "app/Cliente.php";
    $cpf = $obj["cpf"];
    $cliente = new Cliente($nome, $idade, $cpf, "");
    $cliente->cadastra($pdo);

    http_response_code(201);
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}