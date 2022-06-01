<?php




class Database
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database="filrouge";
	private $conn;

	public function __construct()
	{

		try {
			  $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
			//   echo 'connection is Done!';
			} catch(PDOException $e) 
			{
			  echo "Connection failed: " . $e->getMessage();
			}
	}

	public function insert($table,$tableCln,$tableVal)
	{
		$names="";
		$values="";
		$vrls="";
		for ($i=0; $i <count($tableCln) ; $i++)
		{ 
			if ($i>0) 
			{
				$vrls=",";
			}
			$names.=$vrls."`".$tableCln[$i]."`";
			$values.=$vrls."'".$tableVal[$i]."'";
		}
		$str="INSERT INTO `$table`(".$names.") VALUES (".$values.")";
		$query=$this->conn->prepare($str);
		if($query->execute()) {
			return true;
		}else {
			return false;
		}
	}

	public function selectAll($table)
	{
		$query=$this->conn->prepare("SELECT * FROM `$table`");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function selectOne($table, $searchFor, $val)
	{
		$str = "SELECT * FROM `$table` WHERE " . $searchFor ."=?";
		$query=$this->conn->prepare($str);
		$query->execute(
			[$val]
		);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function delete($table,$id)
	{
		$query=$this->conn->prepare("DELETE FROM `$table` WHERE id=$id");
		return $query->execute();
	}

	public function update($table,$id,$tableCln,$tableVal)
	{
		$str="";
		for ($i=0; $i <count($tableCln) ; $i++)
		{ 
			if ($i>0) 
			{
				$str.=",";
			}
			$str.="`".$tableCln[$i]."`='".$tableVal[$i]."'";
		}
		$query=$this->conn->prepare("UPDATE `$table` SET ".$str." WHERE id=$id");
		return $query->execute();
	}

	

	
	public function checkUserExist($email) {
		$str = "SELECT * FROM `client` WHERE email=?";
		$query=$this->conn->prepare($str);
		$query->execute(
			[$email]
		);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public static function message($content, $status) {
	    return json_encode(array('message' => $content, 'error' => $status));
	}

	public function getAll() {
		$str = "SELECT * FROM `client` ";
		$query=$this->conn->prepare($str);
		$query->execute(
		);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function alreadyexist($email) {
		$str = "SELECT * FROM `client` where email = ?";
		$query=$this->conn->prepare($str);
		$query->execute(
			array($email)
		);
		if($query->rowCount() > 0) {
			return 1;
		} else {
			return 0;
		}
	}
	

	


	
}