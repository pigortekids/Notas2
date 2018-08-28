<?php

$body = trim(file_get_contents('php://input'));
$obj_json = json_decode($body, true);

$nome = $obj_json["nome"];
$autor = $obj_json["autor"];
$genero = $obj_json["genero"];

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "biblioteca";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO tbl_livro (nome, autor, genero) VALUES ('$nome', '$autor', '$genero');";
    $conn->exec($sql);
    http_response_code(201);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;