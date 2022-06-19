<?php 

require_once('src/Model/connection.php');

class Commande{

    public function __construct(){
        
    }

    public function addCommande(){
        $db = new Database();
        $result = $db->insert('commande',['idC','CreatedAt','total'],[$_POST['user_id'],date('Y-m-d H:i:s'),$_POST['total']]);
        return $result;
    }

    public function getLastCommande(){
        $db = new Database();
        $result = $db->selectLast('commande');
        return $result;
        
    }
}