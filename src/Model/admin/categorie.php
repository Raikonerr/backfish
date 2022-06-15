<?php 

class categorie{
    public function __construct(){
    }
    public function getAll(){
        require_once('src/Model/connection.php');
        $db = new Database();
        return $db->selectAll('categorie');
        
    }
    public function addC($title, $description){
        require_once('src/Model/connection.php');
        $db = new Database();
        $stmt = "INSERT INTO `categorie` (`title` , `description`) VALUES(:title , :description)";
        $query = $db->connection()->prepare($stmt);
        $query->execute(['title'=>$title, 'description'=>$description]);
    }
    
    public function updateC($id, $title, $description){
        require_once('src/model/connection.php');
        $db = new Database();
        $str = "UPDATE `categorie` SET `title`=?,`description`=? WHERE id=?";
        $query = $db->connection()->prepare($str);
        $query->execute([$title, $description, $id]);
        
    }
    public function deleteC($id){
        require_once('src/Model/connection.php');
        $db = new Database();
        $result = $db->delete('categorie',$id);
        return $result;
    }
}