var app = angular.module('simformApp',['datatables']);
app.controller('visitorController', function($scope, $http){
	var BASE_URL = 'http://localhost/practical/';
	$scope.fetchData = function(){
		$http.get(BASE_URL+'visitorController/fetchData').success(function(data){
			$scope.visitorData = data.visitors_data;
		});
	}

	$scope.createVisitor = function(){
		$scope.first_name = $scope.last_name = $scope.email = $scope.dob = $scope.random_number = '';
		$scope.modalTitle = 'Create Visitor';
		$scope.submit_button = 'Insert';
		$scope.openModal();
	}

	$scope.openModal = function(){
		var modal_popup = angular.element('#crudmodal');
		modal_popup.modal('show');
	};

	$scope.closeModal = function(){
		var modal_popup = angular.element('#crudmodal');
		modal_popup.modal('hide');
	};

	$scope.submitForm = function(){
		data = {
			'first_name' : $scope.first_name,
			'last_name' : $scope.last_name,
			'email' : $scope.email,
			'dob' : $scope.dob,
			'random_number' : $scope.random_number ? $scope.random_number : $scope.generateRandomNumber(),
			'action' : $scope.submit_button,
			'id' : $scope.id
		}
		$http({
			method : "POST",
			url : BASE_URL+"visitorController/saveData",
			data : data
		}).success(function(response){
			if(response.success){
				$scope.success = true;
				$scope.error = false;
				$scope.successMessage = response.message;
				$scope.form_data = {};
				$scope.closeModal();
				$scope.fetchData();
			}else{
				$scope.success = false;
				$scope.error = true;
				$scope.errorMessage = response.error;
			}
		});
	}

	$scope.editData = function(id){
		$http({
			method:"POST",
			url:BASE_URL+"visitorController/editData",
			data:{'id':id}
		}).success(function(data){
			$scope.first_name = data.first_name;
			$scope.last_name = data.last_name;
			$scope.email = data.email;
			$scope.dob = data.date_of_birth;
			$scope.id = id;
			$scope.random_number = data.random_number;
			$scope.modalTitle = 'Edit Visitor';
			$scope.submit_button = 'Edit';
			$scope.openModal();
		});
	};

	$scope.generateRandomNumber = function(){
		return Math.floor(10000 + Math.random() * 99999);
	}

	$scope.deleteData = function(id){
		if(confirm("Are you sure you want to remove it?")){
			$http({
				method:"POST",
				url:BASE_URL+"visitorController/deleteData",
				data:{'id':id}
			}).success(function(data){
				$scope.success = true;
				$scope.error = false;
				$scope.successMessage = data.message;
				$scope.fetchData();
			});	
		}
	};

});