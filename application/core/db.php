<?php

class DB{

    private $host;
    private $db ;
    private $user;
    private $pass ;
    private $charset;

    private static $instance = null;

    private static $pdo;

    private function __construct(){

        $params = parse_ini_file('config.ini');

        $this->host = $params['db_host'];
        $this->db = $params['db_name'];
        $this->user = $params['db_username'];
        $this->pass = $params['db_password'];
        $this->charset = $params['db_charset'];


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