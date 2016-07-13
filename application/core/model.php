<?php

class Model
{

    protected $pdo;

    public function __construct()
    {
        return $this->pdo = DB::getPDO();
    }

    protected function selectAllFromTable($table){
        $sql = "SELECT * FROM $table";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    protected function getUser($id = null){

    }

    function getUserByFbId($userFbId){
        $sql = "SELECT * FROM users WHERE fb_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userFbId]);
        return $stmt->fetch();
    }

    public function get_data()
    {
        
    }
}