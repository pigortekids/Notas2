<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\controller\Controller;
#use \app\classes\Cliente;
#use \app\model\BoloDAOImplementation as BoloDAO;

require_once 'config.php';

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

$app = new \Slim\App;

#tira o tratamento de exceção automatico do Slim
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

    $this->post('/aluguel/{nomeCliente}', function (Request $request, Response $response, array $args) {
        $controlador = new Controller();
        return $controlador->cadastraAluguel($request, $response, $args);
    });

    $this->get('/teste/{teste}', function (Request $request, Response $response, array $args) {
        return $response->write($args["teste"])->withStatus(201);
    });

    /*
    $this->delete('/livro/{idLivro}', function (Request $request, Response $response, array $args) {
        $controlador = new Controller();
        return $controlador->deletaLivro($request, $response, $args);
    });
    $this->put('/bolo/{idBolo}', function (Request $request, Response $response, array $args) {
        $controlador = new ControladorApp();
        return $controlador->updateBolo($request, $response, $args);
    });
    */

});

#erro 404
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404);
    };
};

$app->run();