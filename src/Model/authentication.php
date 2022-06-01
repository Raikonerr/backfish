<?php
require_once('src/model/connection.php');

class Authentication extends Database
{
    public function  __construct()
    {
    }

    public function signup($data)
    {
        // require_once('connection.php');
        // $sql='INSERT INTO client(username,adresse,date_naissance,email,password) VALUES(?,?,?,?,?)';
        // $sql=$this->conn->prepare($sql);
        // $sql->execute(array($data['username'],$data['adress'],$data['date_de_naissance'],$data['email'],$data['password']));


        require_once('connection.php');
        $db = new Database();
        $result = $db->insert('client', ['email', 'username', 'adresse', 'date_de_naissance', 'password'], [$data['email'], $data['username'], $data['adresse'], $data['date_de_naissance'], $data['password']]);
        return $result;
    }


    public function signin($data)
    {
        require_once('connection.php');
        $db = new Database();
        $result = $db->getAll();
        foreach ($result as $row) {
            if (password_verify($data['password'], $row['password']) ) {
                return 1;
            }
        }
    }
    public function alreadyexist($email)
    {
        require_once('connection.php');
        $db = new Database();
        return $db->alreadyexist($email);
    }



    // public function login($data){
    //     require_once('connection.php');
    //     $db = new Database();
    //     $result = $db->selectAll('client');
    //     foreach ($result as $value) {
    //         if(password_verify($value['password'],$data['password']) && $value['email']==$data['email']){
    //             return 1;
    //         }
    //     }
    //     return 0;
    // }
}
