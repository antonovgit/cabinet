// Проинициализируем наше приложение
var cabinet = angular.module('cabinet', []);

cabinet.controller("cabinetController", function($scope, $window){

	$scope.openOrderDetails = function(orderId) {

		$window.location.href = "cabinet/orders?orderId=" + orderId; // при клике на строку будет переход на страницус айди заказа
	}

});