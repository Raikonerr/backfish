<?php

Class product{

  public function addProduct($name, $description, $prix ,$quantity, $idCa, $image){
    require_once('src/Model/connection.php');
    $db = new Database();
    $str = "INSERT INTO `produit` (`name`, `description`, `prix` ,`quantity`, `idCa`, `image`) VALUES(:name, :description, :prix, :quantity, :idCa, :image)";
    $query = $db->connection()->prepare($str);
    $query->execute(['name'=>$name, 'description'=>$description, 'prix'=>$prix ,'quantity'=>$quantity, 'idCa'=>$idCa, 'image'=>$image]);
}

public function editProduct($name, $description, $prix ,$quantity,  $image,$id){
    require_once('src/Model/connection.php');
    $db = new Database();
    $str = "UPDATE `produit` SET `name` = ?,`description`=?, `prix`=? , `quantity`=?, `image`=? WHERE id = ?";
    $query = $db->connection()->prepare($str);
    $query->execute([$name, $description, $prix, $quantity,$image,$id]);
    return $db->selectAll('produit');
}

public function deleteProduct($id){
    require_once('src/Model/connection.php');
    $db = new Database();
    $query=$db->connection()->prepare("DELETE FROM `produit` WHERE id=?");
$query->execute([$id]);
    return true;
}

public function fetchProduct(){
    require_once('src/Model/connection.php');
    $db = new Database();
    $query=$db->connection()->prepare("SELECT p.id, p.name, p.prix, p.quantity, p.image, c.title FROM produit as p inner join categorie as c on c.id = p.idCa where p.quantity!=0");
    // $query=$db->connection()->prepare("SELECT * FROM `produit` ");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
    
}

public function fetchSingleProduct($id){
    require_once('src/Model/connection.php');
    $db = new Database();
    $query=$db->connection()->prepare("SELECT * FROM `produit` WHERE id=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}


// public function fetchProducts(){
//     require_once('src/Model/connection.php');
//     $db = new Database();
//     $query=$db->connection()->prepare("SELECT * FROM `produit`");
//     $query->execute();
//     return $query;
// }





  

}