<?php

session_start();

if(isset($_SESSION['id'])){
    echo "bem vindo ".$_SESSION['id']."!";

}
else{

    

    $_SESSION['nome'] = "Batatinha";
    $_SESSION['RA'] = "15.00588-7";
    echo "você NUNCA entrou aqui";
}