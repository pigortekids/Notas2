<?php
#Global definitions
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

#Getting information from JSON
$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

#Setting up variables
$id_cliente = $obj["id_cliente"];
$cpf = $obj["cpf"];
$nome = $obj["nome"];
$idade = $obj["idade"];

#Creating query
$query = "UPDATE tbl_cliente SET (";
$have_statment_before = false;
if ($cpf != ""){
    $query += "cpf = :CPF";
    $have_statment_before = true;
}
if ($nome != ""){
    if ($have_statment_before){
        $query += " AND ";
    }
    $query += "nome = :NOME";
    $have_statment_before = true;
}
if ($idade != ""){
    if ($have_statment_before){
        $query += " AND ";
    }
    $query += "idade = :IDADE";
}
$query += ") WHERE (id_cliente = :ID_CLIENTE);";

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

    if ($cpf != ""){
        $stmt->bindParam(":CPF", $cpf);
    }
    if ($nome != ""){
        $stmt->bindParam(":NOME", $nome);
    }
    if ($idade != ""){
        $stmt->bindParam(":IDADE", $idade);
    }
    $stmt->bindParam(":ID_CLIENTE", $id_cliente);

    $stmt->execute();

    http_response_code(201);

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }