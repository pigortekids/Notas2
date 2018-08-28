<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');


$body = file_get_contents('php://input');
$body = trim($body);
$obj = json_decode($body,true);

$nome = $_GET["nome"];

$host = '127.0.0.1:3306';
$db   = 'mercearia';
$user = 'root'; 
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);


$stmt = $pdo->prepare("SELECT * FROM tbl_cliente WHERE nome = :NOME");
$stmt->bindParam(":NOME", $nome);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);

$resposta = array( "resp"=>$result );
$resposta_json = json_encode($resposta);

header('Content-Type: application/json');
echo $resposta_json;

/*
foreach ($result as $row) {

}
*/