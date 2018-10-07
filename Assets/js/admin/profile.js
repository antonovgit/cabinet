var profile = angular.module('profile', []);

profile.controller("profileController", function($scope, $http, $window){

	$scope.saveProfileData = function() {
		id = angular.element("#userId").val();
		login = angular.element("#login").val();
		email = angular.element("#email").val();

		$http({
			method: "POST",
			//url: "http://cabinet.kamil-abzalov.ru/profile/updateProfile",
			//url: "http://kamil/mvc/cabinet/cabinet/profile/updateProfile",
			url: "http://cabinet/cabinet/profile/updateProfile",
			data: $.param({id: id, login: login, email: email}),
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
			// TODO
			//console.log(result); // http://imagizer.imageshack.com/img923/3007/8vWdX6.jpg
			alert(result.data.text);
		})
	}


	$scope.updatePassword = function() {
		id = angular.element("#userId").val();

		$http({
			method: "POST",
			//url: "http://cabinet.kamil-abzalov.ru/profile/updatePassword",
			//url: "http://kamil/mvc/cabinet/cabinet/profile/updatePassword",
			url: "http://cabinet/cabinet/profile/updatePassword",
			data: $.param({id: id, newpass: $scope.newpass, repeatpass: $scope.repeatpass}),
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
			// TODO
			//console.log(result);
			alert(result.data.text);
		})
	}


})