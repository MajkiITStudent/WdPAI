<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User('jsnow@pk.edu.pl', 'admin', 'John', 'Snow');

        if(!$this->isPost()){
            return $this->login('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        if($user->getEmail() !== $email){
            return $this->render('login', ['messages' => ["User doesn't exist in database"]]);
        }

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ["Password is incorrect"]]);
        }

        //return $this->render('mainpage');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/mainpage");
    }

}