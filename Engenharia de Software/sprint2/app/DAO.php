<?php

namespace app;

class DAO{

    private $dsn;
    private $user;
    private $pass;

    public function __construct($host, $db, $charset, $user, $pass){
        $this->dns = "mysql:host=$host;dbname=$db;charset=$charset";
        $this->user = $user;
        $this->pass = $pass;
    }

    public function getDns(){
        return $this->dns;
    }

    public function getUser(){
        return $this->user;
    }

    public function getPassword(){
        return $this->pass;
    }

}