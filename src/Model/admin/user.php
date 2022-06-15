<?php 
 
 Class User{
        public function __construct(){
        }
        public function getAll(){
            require_once('Model/connection.php');
            $db = new Database();
            $result = $db->selectAll('user');
            return $result;
        }
        public function add(){
            require_once('Model/connection.php');
            $db = new Database();
            $result = $db->insert('user', ['nom', 'prenom', 'email', 'password'], [$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']]);
            return $result;
        }
        public function update($id){
            require_once('Model/connection.php');
            $db = new Database();
            $result = $db->update('client',['username', 'adresse','date_de_naissance', 'email', 'password'], [$_POST['username'], $_POST['adresse'],'date_de_naissance',$_POST['email'], $_POST['password']],$id);
            return $result;
        }
        public function delete($id){
            require_once('src/Model/connection.php');
            $db = new Database();
            $result = $db->delete('client',$id);
            return $result;
        }

        public function fetch(){
            require_once('src/Model/connection.php');
            $db = new Database();
            $query=$db->connection()->prepare("SELECT id,username,email,adresse FROM `client`");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        }
 
 