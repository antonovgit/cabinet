// Проинициализируем наше приложение
var users = angular.module('users', []);

users.controller("usersController", function($scope, $http){

	$scope.getUserData = function(userId) {
			//console.log(userId); //  выводит айди пользователя 1,2,3..
        // получим данные из БД
		$http({ // позволяет отправлять на сервер запросы
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/users/getUserById",
            url: "http://cabinet/cabinet/users/getUserById",
            data: $.param({id: userId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'} //как будто мы передаем закодированные данные с формы
        }).then(function(result){
				//console.log(result); // http://imagizer.imageshack.com/img921/189/umCHKQ.jpg
		   
			$scope.userId = result.data.id;
			$scope.userLogin = result.data.login;
			$scope.userEmail = result.data.email;
			$scope.userFullName = result.data.fullName;
			$scope.userRole = result.data.role;
			$scope.getRoles();
        })
    }

    $scope.getRoles = function() {
        $http({
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/users/getUsersRoles",
            url: "http://cabinet/cabinet/users/getUsersRoles",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
				//console.log(result); // http://imagizer.imageshack.com/img922/5540/GZopIk.jpg
			$scope.roles = [];
			var arr = result.data.length;
            //for(var i=0; i<result.data.length; i++) {
            for(var i=0; i<arr; i++) {
                $scope.roles.push(result.data[i]); // пушу(кладу) в массив роль из моего результирующего запроса
            }
        })
    }
	
	// // !!! Чувак описал решение проблемы с выбором роли в селекте: https://www.youtube.com/watch?v=bt2xt3jUSI8&index=15&list=PLOpdT8GIZ4XU12DJ6RzN07CHIN0vDe2fl
	// // !!!Попробовал внедрить - работает, но НЕ РАБОТАЕТ при обновлении юзера
	// $scope.getRoles = function() {
        // $http({
            // method: "POST",
            // // Рекомендованная запись к оформлению URL, 
            // // одинаково работающая без модификаций как на локальной машине, 
            // // так и на сервере в Интернет !!!  
            // url: location.protocol + "//" + location.host + "/cabinet/users/getUsersRoles",
            // headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        // }).then(function(result){
            // $scope.roles = [];
            // for(var i=0; i<result.data.length; i++) {
                // $scope.roles.push(result.data[i]);
            // }
        // })
    // }

    // // Один раз при загрузке страницы составляем список ролей $scope.roles !!!  
    // $scope.getRoles();
    
    // $scope.getUserData = function(userId) {
        // $http({
            // method: "POST",
            // // Рекомендованная запись к оформлению URL !!!
            // url: location.protocol + "//" + location.host + "/cabinet/users/getUserById",
            // data: $.param({id: userId}),
            // headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        // }).then(function(result){
            // $scope.userId = result.data.id;
            // $scope.userLogin = result.data.login;
            // $scope.userEmail = result.data.email;
            // $scope.userFullName = result.data.fullName;
            // $scope.userRole = result.data.role;
            // // Настраиваем фокус userSelRole на списочный элемент $scope.userRole !!!
            // for(var i=0; i<$scope.roles.length; i++) {
                // loc_val = $scope.roles[i];
                // if (loc_val.name==result.data.role) {
                    // $scope.userSelRole = loc_val;
                    // break;
                // }
            // }
            // console.log($scope);
        // })
    // }
// ///////////////////////////
	

    $scope.updateUserData = function() {
        //console.log($scope.userId, $scope.userFullName, $scope.userLogin, $scope.userEmail, $scope.role); //1 John Smith john2 j@gmail.com 1
		$http({
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/users/updateUserData",
            //url: "http://cabinet/cabinet/users/updateUserData",
			url: location.protocol + "//" + location.host + "/cabinet/users/updateUserData",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            //data: $.param({id: $scope.userId, fullName: $scope.userFullName, login: $scope.userLogin, email: $scope.userEmail, role: $scope.newRole}) // с атрибута data-ng-model="userId" ..
            data: $.param({id: $scope.userId, fullName: $scope.userFullName, login: $scope.userLogin, email: $scope.userEmail, role: $scope.role}) // с атрибута data-ng-model="userId" ..
            //data: $.param({id: $scope.userId, fullName: $scope.fullName, login: $scope.login, email: $scope.email, role: $scope.role}) // у Камиля
        }).then(function(result){
            //TODO: вывести результат
            //console.log(result);
			alert(result.data.text);
			//window.location.reload(); // перегрузка окна
        });
    }

    $scope.deleteUser = function(userId) {
        $http({
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/users/deleteUser",
            //url: "http://cabinet/cabinet/users/deleteUser",
			url: location.protocol + "//" + location.host + "/cabinet/users/deleteUser",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({id: userId})
        }).then(function(result){
            //TODO: вывести результат
            //console.log(result); // http://imagizer.imageshack.com/img921/9005/ZkXmmZ.jpg
			alert(result.data.text);
			//window.location.reload(); // перегрузка окна
        });
    }

    $scope.addNewUser = function() {
        $http({
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/users/addNewUser",
			url: location.protocol + "//" + location.host + "/cabinet/users/addNewUser",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({fullName: $scope.newUser, login: $scope.newLogin, email: $scope.newEmail, password: $scope.newPassword, role: $scope.newRole})
        }).then(function(result){
            //TODO: вывести результат
            //console.log(result); // http://imagizer.imageshack.com/img921/1546/uiVnVv.jpg
			alert(result.data.text);
        });
    }

});


// Вызываем директиву...возвращает объект директивы..директива - это по сути обучения браузера новым тегам
users.directive('editUser', function(){
    return {
        templateUrl: "/views/edit-user-tpl.php",
        //template: "<p>Hello</p>",
        restrict: "E", // элемент(тег) // E - element, A - attribute
        replace: true, // перествить..что бы <edit-user></edit-user> полностью заменилось на код моего шаблона(формы)
        transclude: true,
        controller: "usersController",
        link: function(scope, element, attrs) {
            scope.showEditForm = function() { // выставляет в тру параметр isShowEditForm
                scope.isShowEditForm = true;
            };
        }
    }
})