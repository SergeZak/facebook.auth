<?php

class Controller {

    public $model;
    public $view;
    public $facebook;

    function __construct()
    {
        $this->view = new View();
        $this->facebook = new FacebookService();
    }

    function action_index()
    {
    }

    function redirect($url){

        header('Location: http://'.$_SERVER['HTTP_HOST']. $url);
        exit;

    }
}