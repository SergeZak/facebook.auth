<?php

class DB{

    private $host = 'localhost';
    private $db = 'facebook.auth';
    private $user = 'facebook.auth';
    private $pass = '12345';
    private $charset = 'utf8';

    private static $instance = null;

    private static $pdo;

    private function __construct(){

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        self::$pdo = new PDO($dsn, $this->user, $this->pass, $opt);

    }

    public static function getPDO(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        
        return self::$pdo;
    }

}