<?php

session_start();

if (isset($_SESSION["id"])){
    //$url = "itau.com.br";
    //header(locaion:$url);
    echo("Ja está logado");
}
else{
    $body = file_get_contents('php://input');
    $body = trim($body);
    $obj = json_decode($body,true);

    $nome = $obj["nome"];
    $pass = $obj["senha"];

    $nomeServer = "localhost:3307";
    $usuario = "root";
    $senha = "";
    $dataBase = "xesque";
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$nomeServer;dbname=$dataBase;charset=$charset";
    $con = new PDO($dsn, $usuario, $senha);

    $stmt = $con->prepare("SELECT * FROM tbl_cliente WHERE (nome = :NOME AND senha = :SENHA)");
    $stmt->bindParam(":NOME", $nome);
    $stmt->bindParam(":SENHA", $pass);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if ( $stmt->rowCount() > 0 ) {
        $_SESSION["id"] = $result[0]["id"];
        $_SESSION["permissao"] = $result[0]["permissao"];
        echo("Sim");
    }else{
        echo("usuário ou senha incorretos");
        session_destroy();
    }
}