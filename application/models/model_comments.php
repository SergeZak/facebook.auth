<?php

class Model_Comments extends Model
{



    public function get_data()
    {
        
    }

    function getAllCommentsTree(){
        $sql = "SELECT id, parent_id, body FROM comments";
        $stmt = $this->pdo->query($sql);

        $comments = array();
        while ($comment = $stmt->fetch()){
            $comments[$comment['parent_id']][] =  $comment;
        }

        return $comments;
    }
    
}