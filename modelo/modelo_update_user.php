<?php
$data =  json_decode(file_get_contents('php://input'),TRUE);
if (isset($data['usuario'])){
	require __DIR__ . '/model_users.php';
	$username =  (isset($data['usuario']['username_usuario']) ? $data['usuario']['username_usuario'] : NULL);
	$password =  (isset($data['usuario']['password_usuario']) ? $data['usuario']['password_usuario'] : NULL);
	$privilegio =  (isset($data['usuario']['privilegio_usuario']) ? $data['usuario']['privilegio_usuario'] : NULL);
	$id =  (isset($data['usuario']['id_usuario']) ? $data['usuario']['id_usuario'] : NULL);
	if($username == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Usuario"]]);
	}elseif($password == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Password"]]);
	}elseif($privilegio == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Privilegio"]]);
	}elseif($id == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["Todos los campos son obligatorios, Identificador"]]);
	}else{
		$crud = new Crud();
		echo $crud->updateUser($username,$password,$privilegio,$id);
	}
}else{
	echo json_encode(['errors' => ["Todos los campos son obligatorios"]]);
}
?>