<?php
$data =  json_decode(file_get_contents('php://input'),TRUE);
if (isset($data['usuario'])){
	require __DIR__ . '/model_users.php';
	$id =  (isset($data['usuario']['id']) ? $data['usuario']['id'] : NULL);
	$username =  (isset($data['usuario']['username']) ? $data['usuario']['username'] : NULL);
	$password =  (isset($data['usuario']['password']) ? $data['usuario']['password'] : NULL);
	$privilegio =  (isset($data['usuario']['privilegios']) ? $data['usuario']['privilegios'] : NULL);
	if($id == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Identificador"]]);
	}elseif($username == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Usuario"]]);
	}elseif($password == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Password"]]);
	}elseif($privilegio == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Privilegio"]]);
	}else{
		$crud = new Crud();
		echo $crud->addUsers($id,$username,$password,$privilegio);
	}
}else{
	echo json_encode(['errors' => ["Todos los campos son obligatorios"]]);
}
?>