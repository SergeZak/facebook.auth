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

        $authFacebookLink = $this->facebook->getAuthLinkUrl();

        if(!$isLogged = $this->facebook->isLogged()){
            $user = $this->facebook->AuthenticateUser();
            $this->model->proccessUser($user);
        }
        else{
            $user = $this->model->getUserByFbId($_SESSION['user_id']);
        }


        $this->view->generate('main_view.php', compact('authFacebookLink', 'user', 'isLogged'));
    }

    function action_logout(){
        session_destroy();
        $this->redirect('/');
    }

}