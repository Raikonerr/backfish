<?php

Class Order{
    public function __construct(){
    }
    public function getAll(){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->selectAll('commande');
        return $result;
    }
    public function add(){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->insert('commande', ['idU', 'idP', 'quantite'], [$_POST['idU'], $_POST['idP'], $_POST['quantite']]);
        return $result;
    }
    public function update($id){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->update('commande',['idU', 'idP', 'quantite'], [$_POST['idU'], $_POST['idP'], $_POST['quantite']],$id);
        return $result;
    }
    public function delete($id){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->delete('commande',$id);
        return $result;
    }
}