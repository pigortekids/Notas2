<?php

use app\DAO;

require_once "app/DAO.php";
$con = new DAO('bibliotecawigao.000webhostapp.com', 'id7019223_biblioteca', 'utf8mb4', 'id7019223_cliente', 'wigao');
try {
    $pdo = new PDO($con->getDns(), $con->getUser(), $con->getPassword());
    echo "Connected successfully";

    $query = "SELECT * FROM tbl_livro";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    http_response_code(201);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }