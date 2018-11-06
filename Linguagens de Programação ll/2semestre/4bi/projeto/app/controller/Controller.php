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

            //Descrição é opcional, então caso não tenha sido passada será substituida por ""
            //$desc = (!\is_null($objEntrada["descricao"])) ? $objEntrada["descricao"] : "";

            $arrayCliente = array( "nome"=>$objEntrada["nome"],
                                "idade"=>$objEntrada["idade"],
                                "cpf"=>$objEntrada["cpf"]);
                                //"descricao"=> $desc);

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

    /*
    public function getLivro( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            if ( isset( $args["idLivro"]) ) {
                if ( !is_numeric( $args["idLivro"] ) )
                    throw new BadHttpRequest();
            } else { 
                throw new BadHttpRequest();
            }

            $dao = new LivroDAO();
            $livro = $dao->getLivro( $args["idLivro"] );

            $status = ( !is_null( $livro ) ) ? 200 : 204; 

            $corpoResp =  json_encode( $livro );
            $response = $response->withHeader('Content-type', 'application/json')
                                 ->write( $corpoResp );
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }

    public function deletaLivro( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            if ( isset( $args["idLivro"]) ) {
                if ( !is_numeric( $args["idLivro"] ) )
                    throw new BadHttpRequest();
            } else { 
                throw new BadHttpRequest();
            }

            $dao = new LivroDAO();
            $sucesso = $dao->deleteBoloById( $args["idLivro"] );
            $status = ( $sucesso ) ? 200 : 204;
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }
    
    # Por simplificação será preciso enviar todos os valores e o update ocorrerá no objeto inteiro.
    public function updateBolo( Request $request, Response $response, array $args )
    {

        $status = 200;

        try {

            # Verifica o argumento que vem via URL
            if ( isset( $args["idBolo"]) ) {
                if ( !is_numeric( $args["idBolo"] ) )
                    throw new BadHttpRequest();
            } else { 
                throw new BadHttpRequest();
            }

            # Verificar erro na entrada
            # Esperamos uma entrada Json da seguinte forma:
            # {"nome":"valor","sabor":"valor","cobertura":"valor","descricao":"valor"}
            $objEntrada = $request->getParsedBody();            

            # getParsedBody, irá parsear o Json de entrada, caso ele falhe
            # pela entrada não ser um Json válido, esse if irá capturar
            if ( is_null($objEntrada) )
                throw new BadHttpRequest();

            # Verifica se os campos obrigatórios estão preenchidos
            if (!( isset( $objEntrada["nome"] ) &&
            isset( $objEntrada["sabor"] ) &&
            isset( $objEntrada["cobertura"])))
                throw new BadHttpRequest();

            # Descrição é opcional, então caso não tenha sido passada será substituida por ""
            $desc = (!\is_null($objEntrada["descricao"])) ? $objEntrada["descricao"] : "";

            $arrayBolo = array( "nome"=>$objEntrada["nome"],
                                "sabor"=>$objEntrada["sabor"],
                                "cobertura"=>$objEntrada["cobertura"],
                                "descricao"=> $desc);

            $boloInst = new Bolo($arrayBolo);
            $dao = new BoloDAO();
            $sucesso = $dao->updateBoloById( $args["idBolo"]  , $boloInst );
            $status = ( $sucesso ) ? 200 : 204;

        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch (\PDOException $e) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        }

        return $response->withStatus($status);
    }

    */
}