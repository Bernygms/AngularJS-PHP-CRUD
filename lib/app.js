var myApp = angular.module('crud', []);
myApp.controller('crudController', function($scope,$http){
	$scope.usuarios = [];
	$scope.usuario = {};
	$scope.destalles_usuario = {};
	$scope.errors = [];
	//Metodo para consultar all
	$scope.importar = function(){
			$http.get('modelo/model_list_users.php',{})
			.then(function success(e){
			$scope.usuarios = e.data.userlist;
			}, function error(e){
			console.log('Se ha producido un error al recuperar la informacion');
		});

	};
	$scope.importar();
	//Metodo para registrar 
	$scope.addUser = function(){
			$http.post('modelo/model_create_user.php',{
				usuario:$scope.usuario
			})
			.then(function success(e){
				$scope.errors = [];
				$scope.usuarios.push(e.data.usuario);
				var modal_element = angular.element('#add_nuw_cliente');
				modal_element.modal('hide');
			},function error(e){
				$scope.errors =  e.data.errors
			});
	};

	//Metodo para eliminar 
	$scope.deleteUser = function(index){
		var conf =  confirm("Realmente quieres eliminar el usuario.?");

		if (conf==true) {
			$http.post('modelo/model_delete_user.php',{
				usuario:$scope.usuarios[index]
			})
			.then(function success(e){
				$scope.errors = [];
				$scope.usuarios.splice(index,1);
			}, function error(e){
				$scope.errors = e.data.errors;
			});
		}
	};

	//Metodo para recuperar 
	$scope.getUser = function(index){
		$scope.destalles_usuario = $scope.usuarios[index];
		var modal_element = angular.element('#modal_update');
		modal_element.modal('show');

	};

	//Metodo paraactualizar 
	$scope.updateUser = function(){
		$http.post('modelo/modelo_update_user.php',{
			usuario:$scope.destalles_usuario
		})
		.then(function success(e){
			$scope.errors = [];
			var modal_element = angular.element('#modal_update');
			modal_element.modal('hide');
		}, function error(e) {
			$scope.errors = e.data.usuario;
		})
	};
});