<?php 

namespace app;

use \PDO;

class DAO{
	private $nomeServer;
	private $usuario;
	private $senha;
	private $dataBase;
    private $charset;
    public 	$con;
	function __construct() {
		$this->nomeServer = "localhost";
		$this->usuario = "root";
		$this->senha = "";
        $this->dataBase = "celulares";
        $this->charset = 'utf8mb4';
        $dsn = "mysql:host=$this->nomeServer;dbname=$this->dataBase;charset=$this->charset";
        $this->con = new PDO($dsn, $this->usuario, $this->senha);
	}
}
