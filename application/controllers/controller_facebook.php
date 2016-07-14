<?php

class Controller_Facebook extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new Model_Facebook();
    }
    
    function action_index()
    {

        $user = $this->facebook->AuthenticateUser();
        $this->model->proccessUser($user);
        $this->redirect('/comments');

    }

}