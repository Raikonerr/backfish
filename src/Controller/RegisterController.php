<?php
require_once('src/model/authentication.php');
require_once('src/config/Header.php');
require_once('src/model/connection.php');
class RegisterController
{
    public function signUp()
    {

        $signup = new Authentication();
        $data = [
            'username' => $_POST['username'],
            'adresse' => $_POST['adresse'],
            'date_de_naissance' => $_POST['date_de_naissance'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];

        if ($signup->alreadyexist($data['email']) == 1) {
            echo Database::message('ce email est deja utilise',true);
        }elseif ($signup->signup($data)) {
            echo Database::message('Inscription reussi', false);
        }
    }

    public function signIn()
    {
        $data=[
            'email'=>$_POST['email'],
            'password'=>$_POST['password']
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            require_once('src/model/authentication.php');
            require_once('src/config/Header.php');
                $auth =  new Authentication();
                if($auth->signin($data)){
                    echo Authentication::message('Connexion reussi', false);
                }else {
                    echo Authentication::message('Email', true);
                }
        }

    }
}
