<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\DAO;
use app\Celular;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/celular', function (Request $request, Response $response, array $args) {
    
    require_once "../app/DAO.php";
    try {
        
        $con = new DAO('localhost', 'celulares', 'utf8mb4', 'root', '');
        $pdo = new PDO($con->getDns(), $con->getUser(), $con->getPassword());

        require_once "../app/Celular.php";
        $celular = new Celular();
        $resultado = $celular->selecionaTudo($pdo);
        $response->getBody()->write($resultado);

        http_response_code(201);
    }
    catch(PDOException $e)
    {
        $response->getBody()->write("Connection failed: " . $e->getMessage());
    }

    return $response;

});

$app->get('/celular/{id}', function (Request $request, Response $response, array $args) {

    $id_celular = $args['id'];
    
    require_once "../app/DAO.php";
    try {
        
        $con = new DAO('localhost', 'celulares', 'utf8mb4', 'root', '');
        $pdo = new PDO($con->getDns(), $con->getUser(), $con->getPassword());

        require_once "../app/Celular.php";
        $celular = new Celular($id_celular);
        $resultado = $celular->selecionaPorId($pdo);
        $response->getBody()->write($resultado);

        http_response_code(201);
    }
    catch(PDOException $e)
    {
        $response->getBody()->write("Connection failed: " . $e->getMessage());
    }

    return $response;

});

$app->run();