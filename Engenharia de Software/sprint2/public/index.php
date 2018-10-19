<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\Celular;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/celular', function (Request $request, Response $response, array $args) {
    
    try {
        require_once "../app/Celular.php";
        $celular = new Celular();
        $resultado = $celular->selecionaTudo();
        $response->getBody()->write($resultado);

        http_response_code(201);
    }
    catch(PDOException $e)
    {
        $response->getBody()->write("Connection failed: " . $e->getMessage());
    }

    return $response;

});

$app->get('/celular/{nome}', function (Request $request, Response $response, array $args) {

    $nome = $args['nome'];
    
    try {
        require_once "../app/Celular.php";
        $celular = new Celular();
        $celular->selecionaPorNome($nome);
        $response->getBody()->write(json_encode($celular));

        http_response_code(201);
    }
    catch(PDOException $e)
    {
        $response->getBody()->write("Connection failed: " . $e->getMessage());
    }

    return $response;

});

$app->run();