<?php

class Controller_Main extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new Model_Main();
    }
    
    function action_index()
    {
        $isLogged = $this->facebook->isLogged();
        $authFacebookLink = $this->facebook->getAuthLinkUrl();

        if(!$isLogged){
            $user = $this->facebook->AuthenticateUser();
            $this->model->proccessUser($user);
        }
        else{
            $user = $this->model->getUserByFbId($_SESSION['user_id']);
        }


        $this->view->generate('main_view.php', compact('authFacebookLink', 'user', 'isLogged'));
    }

}