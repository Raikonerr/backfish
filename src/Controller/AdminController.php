<?php 

require_once('src/Model/admin/product.php');
require_once('src/config/Header.php');
require_once('src/Model/connection.php');
require_once('src/Model/admin/commande.php');





class AdminController{
    public function __construct(){
    }

    // crud product
    public function addP(){


 $target_dir = "src/public/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  } 


  // Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  } 


  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
} 

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }


        require_once('src/config/Header.php');
        require_once('src/Model/admin/product.php');
        $p = new Product();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                $name = $_POST['name'];
                $description = $_POST['description'];
                $prix = $_POST['prix'];
                $quantity = $_POST['quantity'];
                $idCa = $_POST['idCa'];
                $image = $_FILES['image']['name'];
            
            if(!empty($name) && !empty($description) && !empty($prix) && !empty($quantity) && !empty($idCa) && !empty($image)){
                $p->addProduct($name, $description, $prix, $quantity, $idCa, $image);
              echo AdminController::message('Produit ajouté avec succès',false);

            }else{
                echo AdminController::message('Veuillez remplir tous les champs',true);
            }

            }else {
                echo AdminController::message('change to post',true);
            }
        }

        public function editP(){
            require_once('src/config/Header.php');
            require_once('src/Model/admin/product.php');
            $p = new Product();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                $name = $_POST['name'];
                $description = $_POST['description'];
                $prix = $_POST['prix'];
                $quantity = $_POST['quantity'];
                // $idCa = $_POST['idCa'];
                $image = $_FILES['image']['name'];
                $id = $_POST['id'];

                
            
            if(!empty($name) && !empty($description) && !empty($prix) && !empty($quantity)  && !empty($image)){
                $p->editProduct($name, $description, $prix, $quantity, $image,$id);
              echo AdminController::message('Produit modifié avec succès',false);

            }else{
                echo AdminController::message('Veuillez remplir tous les champs',true);
            }

            }else {
                echo AdminController::message('change to post',true);
            }
        }

        public function deleteP(){
            require_once('src/config/Header.php');
            require_once('src/Model/admin/product.php');
            $p = new Product();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                $id = $_POST['id'];
            
            if(!empty($id)){
                $p->deleteProduct($id);
              echo AdminController::message('Produit supprimé avec succès',false);

            }else{
                echo AdminController::message('Veuillez remplir tous les champs',true);
            }

            }else {
                echo AdminController::message('change to post',true);
            }
        }

        public function fetchP(){
            
            require_once('src/config/Header.php');
            require_once('src/Model/admin/product.php');
            $p = new Product();
            if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
                $result = $p->fetchProduct();
                    echo json_encode($result);
                    // print_r(json_encode($result));

            }else {
                echo AdminController::message('change to get',true);
            }
        }

            public function fetchOneP(){
                require_once('src/config/Header.php');
                require_once('src/Model/admin/product.php');
                $p = new Product();
                if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
                    $params = explode('/', $_GET['p']);
                    $result = $p->fetchSingleProduct($params[2]);
                        echo json_encode($result);
                        // print_r(json_encode($result));
                }else{
                    echo AdminController::message('change to get',true);
                }
        }


    




    






  


    //crud Categories
     public function addC(){
        require_once('src/config/Header.php');
        require_once('src/Model/admin/categorie.php');
        $c = new Categorie();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                $title = $_POST['title'];
                $description = $_POST['description'];
                
            
            if(!empty($title) && !empty($description)){
                $c->addC($title, $description);
              echo AdminController::message('Categorie ajouté avec succès',false);

            }else{
                echo AdminController::message('Veuillez remplir tous les champs',true);
            }

            }else {
                echo AdminController::message('change to post',true);
            }
        }

        public function editC(){
        
            require_once('src/config/Header.php');
            require_once('src/model/admin/Categorie.php');
            $c = new Categorie();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $title = $_POST['title'];
                $description = $_POST['description'];
                $id = $_POST['id'];
                if(!empty($title) && !empty($description) && !empty($id))
                {
                    $result = $c->updateC($id, $title, $description);
                    echo AdminController::message('user categories has been updated', false);
                }else {
                    echo AdminController::message('please fill all field', true);
                }
            }else {
                echo AdminController::message('invalide request', true);
            }
        }

        public function deleteC(){
            require_once('src/config/Header.php');
            require_once('src/Model/admin/categorie.php');
            $c = new Categorie();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id']; 
                $d=$c->deleteC($id);
                if($d){
                    echo AdminController::message('Categorie supprimé', false);
                }
              
        }else {
            echo AdminController::message('change to post',true);
        }
    }

    public function fetchC(){
        require_once('src/config/Header.php');
        require_once('src/Model/admin/categorie.php');
        $c = new Categorie();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $result = $c->getAll();
            echo json_encode($result);
        }else{
            echo AdminController::message('change to get',true);
        }

    }
   


    //crud User
    public function getAllU(){
        $user = new User();
        $result = $user->getAll();
        return $result;
    }

    public function fetchU(){
        require_once('src/config/Header.php');
        require_once('src/Model/admin/user.php');
        $user = new User();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $result = $user->fetch();
            echo json_encode($result);
    }else{
        echo AdminController::message('change to get',true);
    }
}
 
    public function deleteU(){
        require_once('src/config/Header.php');
        require_once('src/Model/admin/user.php');
        $user = new User();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id']; 
            $d=$user->delete($id);
            if($d){
                echo AdminController::message('Utilisateur supprimé', false);
            }
        else{
            echo AdminController::message('Erreur lors de la suppression', true);
        }
    }
}


// crud panier 
public function addOrder(){
    require_once('src/config/Header.php');
    require_once('src/Model/admin/order.php');
    $panierClass = new Order();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
       $total = $_POST['total'];
       $panier = json_decode($_POST['panier']);
      
        $user = $_POST['user_id'];
        $commande = new Commande();
        $commande->addCommande($total, $user);
        $commande_id = $commande->getLastCommande();
        foreach($panier as $p){
            $p_array = json_decode(json_encode($p), true);
            $panierClass->addPanier($user, $p_array['id'], $commande_id['id'], $p_array['quantityOfUser'], $p_array['price']);
        }
    	echo AdminController::message('Commande ajouté avec succès',false);
    }else {
        echo AdminController::message('change to post',true);


   
    }
}


    public function fetchOrder(){
        require_once('src/config/Header.php');
        require_once('src/Model/admin/order.php');
        $panier = new Order();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $result = $panier->fetchOrders();
            echo json_encode($result);

    }else{
        echo AdminController::message('change to get',true);
    }

}

public function fetchO(){
    require_once('src/config/Header.php');
    require_once('src/Model/admin/order.php');
    $panier = new Order();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
        $result = $panier->getAllO();
        echo json_encode($result);
    }else{
        echo AdminController::message('change to get',true);
    }

}

public function getOneO(){
    require_once('src/config/Header.php');
    require_once('src/Model/admin/order.php');
    $panier = new Order();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
        $params = explode('/', $_GET['p']);
        $result = $panier->getOneO($params[2]);
        echo json_encode($result);
    }else{
        echo AdminController::message('change to get',true);
    }

}

public function deleteO(){
    require_once('src/config/Header.php');
    require_once('src/Model/admin/order.php');
    $panier = new Order();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id']; 
        $d=$panier->deleteO($id);
        if($d){
            echo AdminController::message('Panier supprimé', false);
        }
    else{
        echo AdminController::message('Erreur lors de la suppression', true);
    }
}else{
    echo AdminController::message('change to post',true);
}
}

public function fetchOrderC(){
    require_once('src/config/Header.php');
    require_once('src/Model/admin/order.php');
    $panier = new Order();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
        $result = $panier->fetchTableO($id);
        echo json_encode($result);
    }else{
        echo AdminController::message('change to get',true);
    }

}

public function fetchOrderT(){
    require_once('src/config/Header.php');
    require_once('src/Model/admin/order.php');
    $panier = new Order();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        $params = explode('/', $_GET['p']);
        

        $result = $panier->fetchTableO($params[2]);
        echo json_encode($result);
    }else{
        echo AdminController::message('change to get',true);
    }

}






 

    public function addContact(){
        require_once('src/config/Header.php');
        require_once('src/Model/admin/contact.php');
        $co = new Contact();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            if(!empty($name) && !empty($email) && !empty($message)){
                $co->addCo($name, $email, $message);
              echo AdminController::message('Votre message a été envoyé avec succès',false);

            }else{
                echo AdminController::message('Veuillez remplir tous les champs',true);
            }

            }else {
                echo AdminController::message('change to post',true);
            }
        }


        //crud commande 

        public function addCo(){
            require_once('src/config/Header.php');
            require_once('src/Model/admin/commande.php');
            $co = new Commande();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_user = $_POST['idC'];

                
            
                
            }
        }

    

    public static function message($content, $status) {
	    return json_encode(array(
            'message' => $content, 
            'error' => $status
            ));
	}
}



