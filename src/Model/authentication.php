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
                return $row;
            }
        }
    }
    public function alreadyexist($email)
    {
        require_once('connection.php');
        $db = new Database();
        return $db->alreadyexist($email);
    }

    public function deleteUser($id)
    {
        require_once('connection.php');
        $db = new Database();
        $result = $db->delete('client', $id);
        return Database::message('Suppression reussi', false);
    }



    // public static function message($content, $user_id, $status) {
	//     return json_encode(array(
    //         'status' => $content, 
    //         'body' => $user_id,
    //         'error' => $status
    //         ));
	// }





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
