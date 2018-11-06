<?php 

namespace app\model;

use \PDO;

class DAO {
	private $nomeServer;
	private $usuario;
	private $senha;
	private $dataBase;
    private $charset;
    public 	$con;

	function __construct() {
		$this->nomeServer = "localhost";
		$this->usuario = "id7019223_cliente";
		$this->senha = "wigao";
        $this->dataBase = "id7019223_biblioteca";
        $this->charset = 'utf8mb4';
        $dsn = "mysql:host=$this->nomeServer;dbname=$this->dataBase;charset=$this->charset";

        $this->con = new PDO($dsn, $this->usuario, $this->senha);
	}
}