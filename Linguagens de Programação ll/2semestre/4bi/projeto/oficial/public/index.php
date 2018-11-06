<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\controller\Controller;

require_once 'config.php';

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

$app = new \Slim\App;

$c = $app->getContainer();
unset($c['phpErrorHandler']);

$app->group('/v1',function ( ) {

    $this->get('/livro', function (Request $request, Response $response, array $args) {
        $controlador = new Controller();
        return $controlador->getLivros($request, $response, $args);
    });

    $this->post('/cliente', function (Request $request, Response $response, array $args) {
        $controlador = new Controller();
        return $controlador->cadastraCliente($request, $response, $args);
    });

    $this->get('/aluguel/{nomeCliente}', function (Request $request, Response $response, array $args) {
        $controlador = new Controller();
        return $controlador->getAlugueis($request, $response, $args);
    });

    $this->post('/aluguel', function (Request $request, Response $response, array $args) {
        $controlador = new Controller();
        return $controlador->cadastraAluguel($request, $response, $args);
    });

});

$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404);
    };
};

$app->run();