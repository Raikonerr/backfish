<?php

require_once('src/Model/connection.php');


class Order
{
    public function __construct()
    {
    }
    public function getAllO()
    {

        $db = new Database();
        $result = $db->selectAll('panier');
        return $result;
    }

    //crud for panier 
    public function addP()
    {
        $db = new Database();
        $result = $db->insert('panier', ['idC', 'idP', 'quantity', 'price'], [$_POST['idC'], $_POST['idP'], $_POST['quantity'], $_POST['price']]);
        return $result;
    }

    public function getOneO($id)
    {
        $db = new Database();
        $query = $db->connection()->prepare("SELECT p.name,p.description,p.prix,p.quantity as quantiteProduct,b.price,b.quantity FROM panier b,produit p WHERE b.idP = p.id AND b.idC = ?");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteO($id)
    {
        $db = new Database();
        $query = $db->connection()->prepare("DELETE FROM `panier` WHERE id=?");
        $query->execute([$id]);
        return $query;
    }

    public function fetchTableO($idC)
    {
        $db = new Database();
        $query = $db->connection()->prepare("SELECT o.id, o.price , o.quantity , p.name , c.username from panier as o join produit as p on p.id = o.idP JOIN client as c on c.id = p.idC where p.idC = ? ");

        $query->execute([$idC]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPanier($idC, $idP, $idCommande, $quantity, $price)
    {
        $db = new Database();
        // $query=$db->connection()->prepare("INSERT INTO `panier`( `idC`, `idCommande`, `idP`, `quantity`, `price`) VALUES  (?,?,?,?,?)");
        // $query->execute([$idC,$idCommande,$idP,$quantity,$price]);
        // return $query;
        $query = $db->connection()->prepare("INSERT INTO `panier`( `idC`, `idCommande`, `idP`, `quantity`, `price`) VALUES  (?,?,?,?,?)");
        $sql = $db->connection()->prepare("SELECT quantity FROM produit WHERE id = ?");
        $sql->execute([$idP]);
        $quantityProduct = $sql->fetch(PDO::FETCH_ASSOC);
        $query->execute([$idC, $idCommande, $idP, $quantity, $price]);
        $quantityProduct['quantity'] -= $quantity;
        $sql1 = $db->connection()->prepare("UPDATE produit SET quantity = ? WHERE id = ?");
        $sql1->execute([$quantityProduct['quantity'], $idP]);
        return 1;
    }


    public function fetchOrders()
    {
        $db = new Database();
        $query = $db->connection()->prepare("select  commande.id, client.username , produit.name , panier.quantity , produit.prix , commande.total from panier
        INNER JOIN commande on panier.idCommande = commande.id INNER JOIN client on panier.idC = client.id INNER JOIN produit on panier.idP = produit.id");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteOrders($id)
    {
        $db = new Database();
        $query = $db->connection()->prepare("DELETE FROM `panier` WHERE idCommande = ?");
        $query->execute([$id]);
        return $query;
    }
}
