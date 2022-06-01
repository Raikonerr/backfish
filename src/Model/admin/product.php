<?php

Class produit{
  public function __construct(){

  }
  public function getAll(){
    require_once('Model/connection.php');
    $db = new Database();
    $result = $db->selectAll('produit');
    return $result;
  }


  public function add(){
    require_once('Model/connection.php');
    $db = new Database();
    $result = $db->insert('produit', ['title', 'description', 'prix', 'image','idCa'], [$_POST['title'], $_POST['description'], $_POST['prix'], $_POST['image'],$_POST['idCa']]);
    return $result;
  }

  
  public function update($id){
    require_once('Model/connection.php');
    $db = new Database();
    $result = $db->update('produit',['title', 'description', 'prix', 'image'], [$_POST['title'], $_POST['description'], $_POST['prix'], $_POST['image']],$id);
    return $result;
  }

    public function delete($id){
        require_once('Model/connection.php');
        $db = new Database();
        $result = $db->delete('produit',$id);
        return $result;
    }

}