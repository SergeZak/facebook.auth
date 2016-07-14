<?php

class FacebookService{


    private $client_id; // Client ID
    private $client_secret; // Client secret
    private $redirect_uri ; // Redirect URIs

    private $accessToken;
    private $currentUserId;


    function __construct(){

        $configs = parse_ini_file('config.ini');

        $this->client_id = $configs['facebook_client_id'];
        $this->client_secret = $configs['facebook_client_secret'];

        $this->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].'/facebook/index/';
    }


    private function getParams(){
        return array(
            'client_id'     => $this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code',
            'scope'         => 'email,user_birthday'
        );
    }


    public function getAuthLinkUrl(){

        $params = $this->getParams();

        return 'https://www.facebook.com/dialog/oauth?'. urldecode(http_build_query($params));
    }


    public function AuthenticateUser(){

        if(isset($_GET['code'])){

            $tokenInfo = null;

            parse_str($this->getTokenInfo(), $tokenInfo);

            if(!isset($tokenInfo['access_token']))
                return null;

            if(!$currUserId = $this->getUserInfo($tokenInfo)['id'])
                return null;

            $this->accessToken = $tokenInfo['access_token'];
            $this->currentUserId = $currUserId;

            $this->setAuthCookies();

            return $this->getFullUserInfo();

        }

        return null;
    }

    private function setAuthCookies(){
//        setcookie("access_token", $this->accessToken, time()+60*60*2, '/');
//        setcookie("user_id", $this->currentUserId, time()+60*60*2, '/');

        $_SESSION['user_id'] = $this->currentUserId;
        $_SESSION['access_token'] = $this->accessToken;
    }


    public function getFullUserInfo(){

        $userdId = $this->currentUserId;
        $accessToken = $this->accessToken;

        $url = 'https://graph.facebook.com/v2.5/'.$userdId.'?access_token='.$accessToken.'&fields=id,email,name,picture,first_name,last_name,is_verified,link,middle_name';

        $output = $this->sendCurlGetReq($url);

        return json_decode($output, 1);

    }


    private function getUserInfo($tokenInfo){
        if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
            $params = array('access_token' => $tokenInfo['access_token']);

            $url = 'https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params));

            $output = $this->sendCurlGetReq($url);

            $userInfo = json_decode($output,1);

            if (isset($userInfo['id'])) {
                return $userInfo;
            }
        }
    }


    private function getTokenInfo(){
        $params = array(
            'client_id'     => $this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'client_secret' => $this->client_secret,
            'code'          => $_GET['code']
        );

        $url = 'https://graph.facebook.com/oauth/access_token?'. http_build_query($params);

        $result = $this->sendCurlGetReq($url);

        return $result;
    }


    public function isLogged(){

        if(!isset($_SESSION['access_token']) && !isset($_SESSION['user_id'])){
            return false;
        }

        $userdId = $_SESSION['user_id'];
        $accessToken = $_SESSION['access_token'];

        $url = 'https://graph.facebook.com/v2.5/'.$userdId.'?access_token='.$accessToken.'&fields=id,email,name,picture,first_name,last_name,is_verified,link,middle_name';

        $result = json_decode($this->sendCurlGetReq($url),1);

        if(!!$result && isset($result['id']) && !isset($result['error'])){
            return true;
        }
        return false;
    }


    private function sendCurlGetReq($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }


}