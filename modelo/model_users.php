<?php
require __DIR__ .'/connection.php';
class Crud{
	protected $db;
	public function __construct(){
		$this->db = DB();
	}
	public function Read(){
		$query = $this->db->prepare("SELECT * FROM usuarios");
		$query->execute();
		$data = array();
		while($row = $query-> fetchAll(PDO::FETCH_ASSOC)){
			$data["userlist"] = $row;
		}
		header('Content-type: application/json; charset=utf-8');
		return json_encode($data);
	}

	
	public function addUsers($id,$usename,$password,$privilegio){
		try {
	        $query =  $this->db->prepare("INSERT INTO usuarios(id_usuario,username_usuario,password_usuario,privilegio_usuario) VALUES (?,?,?,?)");
	        $query->execute(array($id, $usename,$password, $privilegio));

	       	return json_encode(['usuario' =>[
				'id_usuario' =>$this->db->LastInsertId(),
				'username_usuario' =>$usename,
				'password_usuario' =>$password,
				'privilegio_usuario' =>$privilegio
			]]);
	    } catch(PDOException $e) {
	        echo $e->getMessage();
	    }
		
	}

	public function deleteUser($user_id){
		try {
        $query = $this->db->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
        $query->bindParam(":id_usuario", $user_id, PDO::PARAM_INT);
        $query->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function updateUser($user, $password, $privilegio,$id){
		try {
        $query = $this->db->prepare("UPDATE usuarios SET username_usuario = :username,password_usuario = :password,privilegio_usuario = :provilegio WHERE id_usuario = :id");
        $query->bindParam(":username", $user, PDO::PARAM_STR);
        $query->bindParam(":password", $password, PDO::PARAM_STR);
        $query->bindParam(":provilegio", $privilegio, PDO::PARAM_INT);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>