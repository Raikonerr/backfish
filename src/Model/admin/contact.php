<?php

class Contact{
public function __construct(){

}
public function addCo(){
    require_once('src/Model/connection.php');
    $db = new Database();
    $result = $db->insert('contact', ['name', 'email', 'message'], [$_POST['name'], $_POST['email'], $_POST['message']]);
    return $result;

}

public function getContact(){
    require_once('src/Model/connection.php');
    $db = new Database();
    $result = $db->selectAll('contact');
    return $result;
}
    

}