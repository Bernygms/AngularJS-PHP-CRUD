<?php
$data =  json_decode(file_get_contents('php://input'),TRUE);
if (isset($data['usuario'])){
	require __DIR__ . '/model_users.php';
	$id =  (isset($data['usuario']['id_usuario']) ? $data['usuario']['id_usuario'] : NULL);
	if($id == NULL){
		http_response_code(400);
		echo json_encode(['errors' => ["No se pudo eliminar el usuario."]]);
	}else{
		$crud = new Crud();
		echo $crud->deleteUser($id);
	}
}else{
	echo json_encode(['errors' => ["El sistema no esta respondiendo."]]);
}
?>