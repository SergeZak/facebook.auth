<?php

class Model_Main extends Model
{

    public function get_data()
    {
        
    }

    function proccessUser($user){
        if(!empty($user)){

            if($this->isNewUser($user['id'])){
                $this->storeNewUser($user);
            }
        }
    }

    function getUserByFbId($userFbId){
        return parent::getUserByFbId($userFbId);
    }

    function isNewUser($userId){

        $sql = "SELECT fb_id FROM users WHERE fb_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return !$stmt->rowCount()? true : false;
    }

    function storeNewUser($user){
        $sql = "INSERT INTO users (fb_id, email, name, picture) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($user['id'], $user['email'], $user['name'], $user['picture']['data']['url']));
    }

}