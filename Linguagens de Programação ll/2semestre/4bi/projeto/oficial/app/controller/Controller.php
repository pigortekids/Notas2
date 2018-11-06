<?php

namespace app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\model\LivroDAO;
use app\model\ClienteDAO;
use app\classes\Cliente;
use app\model\AluguelDAO;
use app\classes\BadHttpRequest;

class Controller
{

    public function getLivros( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            $dao = new LivroDAO();
            $livrosArray = $dao->getLivros();

            $corpoResp =  json_encode( $livrosArray );
            $response = $response->withHeader('Content-type', 'application/json')
                                 ->write( $corpoResp );
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }

    public function cadastraCliente( Request $request, Response $response, array $args )
    {
        $status = 201;
        try {
            $objEntrada = $request->getParsedBody();

            if (!( isset( $objEntrada["nome"] ) &&
            isset( $objEntrada["idade"] ) &&
            isset( $objEntrada["cpf"])))
                throw new BadHttpRequest();

            if ( is_null($objEntrada) )
                throw new BadHttpRequest();

            $arrayCliente = array( "nome"=>$objEntrada["nome"],
                                "idade"=>$objEntrada["idade"],
                                "cpf"=>$objEntrada["cpf"]);

            $cliente = new Cliente($arrayCliente);
            $dao = new ClienteDAO();
            $dao->createCliente( $cliente );
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->errorMessage(). '\n');
        } catch (\PDOException $e) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        }

        return $response->withStatus($status);
    }

    public function getAlugueis( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            if (!( isset( $args["nomeCliente"]) )) {
                throw new BadHttpRequest();
            }

            $dao = new AluguelDAO();
            $alugueisArray = $dao->getAlugueis( $args["nomeCliente"] );

            $corpoResp =  json_encode( $alugueisArray );
            $response = $response->withHeader('Content-type', 'application/json')
                                 ->write( $corpoResp );
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }

    public function cadastraAluguel( Request $request, Response $response, array $args )
    {
        $status = 201;
        try {
            $objEntrada = $request->getParsedBody();

            if (!( isset( $objEntrada["id_livro"] ) &&
            isset( $objEntrada["nome_cliente"]))){
                throw new BadHttpRequest();
            }

            if ( is_null($objEntrada) ){
                throw new BadHttpRequest();
            }

            $dao = new AluguelDAO();
            $dao->cadastraAluguel( $objEntrada["id_livro"], $objEntrada["nome_cliente"] );
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->errorMessage(). '\n');
        } catch (\PDOException $e) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        }

        return $response->withStatus($status);
    }
	
}