<?php

class Model_Comments extends Model
{



    public function get_data()
    {
        
    }

    function getAllCommentsTree(){
        $sql = "SELECT t1.id, t1.parent_id, t1.body, t1.date_created, t1.date_updated, t2.fb_id, t2.picture FROM comments t1 LEFT JOIN users t2 ON t1.user_id = t2.fb_id WHERE t1.parent_id = 0 ORDER BY date_created DESC";
        $stmt = $this->pdo->query($sql);

        $comments = array();
        while ($comment = $stmt->fetch()){
            $comments[$comment['parent_id']][] =  $comment;
        }

        $sql = "SELECT t1.id, t1.parent_id, t1.body, t1.date_created, t1.date_updated, t2.fb_id, t2.picture  FROM comments t1 LEFT JOIN users t2 ON t1.user_id = t2.fb_id WHERE t1.parent_id != 0 ORDER BY date_created ASC";
        $stmt = $this->pdo->query($sql);
        while ($comment = $stmt->fetch()){
            $comments[$comment['parent_id']][] =  $comment;
        }

        return $comments;
    }


    function add_comment($commentBody, $parentId){
        $userId = $_SESSION['user_id'];
        $body = $commentBody;
        $dateCreated = time();
        $dateUpdated = time();

        $sql = 'INSERT INTO comments (parent_id, user_id, body, date_created, date_updated) VALUES (?,?,?,?,?)';
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute([$parentId, $userId, $body, date("Y-m-d H:i:s", $dateCreated), date("Y-m-d H:i:s", $dateUpdated)]);

        return $res;
    }
}