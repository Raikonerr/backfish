<?php 

class categorie{
    public function __construct(){
    }
    public function getAll(){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->selectAll('categorie');
        return $result;
    }
    public function add(){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->insert('categorie', ['title'],['description'], [$_POST['title'],[$_POST['description']]]);
        return $result;
    }
    public function update($id){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->update('categorie',['title'],['desc'] [$_POST['title']],$id);
        return $result;
    }
    public function delete($id){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->delete('categorie',$id);
        return $result;
    }
}