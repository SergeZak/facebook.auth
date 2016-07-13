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
        $this->view->generate('comments_view.php');
    }
}