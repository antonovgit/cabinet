//Для реализации модального bootstrap окна нужно подключить зависимость ui.bootstrap. После этого будет доступен сервис $uibModal, у которого есть один единственный метод open(), в который передается объект с различными параметрами. Внутри самого модального окна управление идет с помощью $uibModalInstance.

// Проинициализируем наше приложение
var news = angular.module('news', ['ui.bootstrap']);

// Инициализируем наш контроллер
news.controller('newsController', function($scope, $http, $uibModal) {

	$scope.open = function(id) {
		
		$http({
			method: "POST",
			//url: "http://cabinet.kamil-abzalov.ru/cabinet/news/getNewsById",
			url: location.protocol + "//" + location.host + "/cabinet/news/getNewsById",
			data: $.param({id: id}),
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
			console.log(result); // http://imagizer.imageshack.com/img923/7209/vwi5Jx.jpg
			if(result.data.success != false) { // если новости есть..если новость пришла из этого урла, то инициализируем модальное окно
				$scope.newsData = result.data;

				var modalWindow = $uibModal.open({
					animation: true, // устанавливает или сбрасывает анимацию
					controller: "modalWindowController", // это контроллер внутри модального окна..как только откроется модальное окно, то инициализируется объект..нам становится доступен новый сервис внутри этого контроллера, этот сервис называется $uibModalInstance, он представляет зависимость модального окна, т.е. с модальным окном мы будем взаимодействовать через $uibModalInstance 
					templateUrl: '/views/modal.tpl.php', // шаблон нашей модалки
					resolve: {  // резолв это ф-ция, которая передаст объект данных newsData в контроллер модалки modalWindowController
						newsData: function(){
							return $scope.newsData;
						}
					}
				})
			}
		});

	}

});

// Инициализируем контроллер модального окна
news.controller('modalWindowController', function($scope, $http, $window, $uibModalInstance, newsData) {

	// Передаем в модальное окно данные
	$scope.newsId = newsData.id;
	$scope.newsTitle = newsData.title;
	$scope.newsDescription = newsData.description;
	//$scope.newsContent = newsData.content;

	/* $scope.save = function() {

	} */

	$scope.close = function() { // закрываем модальное окно, при клике не Закрыть
		$uibModalInstance.dismiss('cancel');
	}


	$scope.save = function() {
		$http({
			method: "POST",
			//url: "http://cabinet.kamil-abzalov.ru/cabinet/news/save",
			url: location.protocol + "//" + location.host + "/cabinet/news/save",
			data: $.param({id: $scope.newsId, title: $scope.newsTitle, text: $scope.newsDescription}),
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
			alert(result.data.text);
			$uibModalInstance.close();
			$window.location.href = 'cabinet/news';
		})
	}
	
	/* // ДЗ: Реализовать добавление новости
	$scope.add = function() {
		$http({
			method: "POST",
			//url: "http://cabinet.kamil-abzalov.ru/cabinet/news/save",
			url: location.protocol + "//" + location.host + "/cabinet/news/add",
			data: $.param({id: $scope.newsId, title: $scope.newsTitle, text: $scope.newsDescription}),
			data: $.param({fullName: $scope.newUser, login: $scope.newLogin, email: $scope.newEmail, password: $scope.newPassword, role: $scope.newRole})
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
			console.log(result); //
			alert(result.data.text);
			//$uibModalInstance.close();
			$window.location.href = 'cabinet/news';
		})
	} */
	
})