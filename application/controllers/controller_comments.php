<?php

class Controller_Comments extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new Model_Comments();
    }
    
    function action_index()
    {

        $commentsTree = $this->model->getAllCommentsTree();

        $userId = $this->facebook->isLogged()? $_SESSION['user_id'] : 0;

        $this->view->generate('comments_view.php', compact('commentsTree', 'userId'));
    }

    function action_add_comment(){
        if(isset($_POST['comment_body']) && isset($_POST['parent_id'])){

            $body = $_POST['comment_body'];
            $parent_id = $_POST['parent_id'];

            $res = $this->model->add_comment($body, $parent_id);


            if($res){
                $this->redirect('/comments');
            }
            else{
                echo "No";
            }
        }
    }


    function action_edit_comment(){
        if(isset($_POST['comment_body']) && isset($_POST['comment_id'])){

            $body = $_POST['comment_body'];
            $comment_id = $_POST['comment_id'];

            $res = $this->model->edit_comment($body, $comment_id);


            if($res){
                $this->redirect('/comments');
            }
            else{
                echo "No";
            }
        }
    }
}