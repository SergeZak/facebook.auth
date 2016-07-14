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

        if(!$this->facebook->isLogged()){
            $authFacebookLink = $this->facebook->getAuthLinkUrl();
            $user = false;
            $this->view->generate('main_view.php', compact('authFacebookLink', 'user'));
        }
        else{
            $this->redirect('/comments');
        }



    }

    function action_logout(){
        session_destroy();
        $this->redirect('/');
    }

}