<?php

require_once "app/Usuario.php";
require_once "app/Livro.php";

use app\Usuario;

$user = new Usuario('328.926.998-19', 'Igor', 'igor@terra.com.br');

echo "Nome: ".$user->getNome()."<br>";