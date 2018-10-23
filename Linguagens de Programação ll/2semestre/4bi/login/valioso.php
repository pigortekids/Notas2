<?php

session_start();

if(isset($_SESSION["id"])){

    if ($_SESSION["permissao"] == 1){
        echo "Tem permissão para esse componente";
    }else{
        echo "Não tem acesso a esse componente";
    }

}else{

    echo "Redirencionando para autenticação";
    //header(location:"voltaInicial.com.br");

}