/* // https://stackoverflow.com/questions/17544558/angularjs-multiple-ng-view-in-single-template?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
// https://github.com/angular-ui/ui-router/tree/legacy
// https://www.youtube.com/watch?v=QETUuZ27N0w&feature=youtu.be
angular.module('main', ['ui.router'])
.config(['$locationProvider', '$stateProvider', function ($locationProvider, $stateProvider) {
	$stateProvider
	.state('home', {
		url: '/',
		views: {
			'header': {
				templateUrl: '/app/header.html'
			},
			'content': {
				templateUrl: '/app/content.html'
			}
		}
	});
}]); */

/* var app = angular.module('products', ['ui.router']);
app.config(['$locationProvider', '$stateProvider', function ($locationProvider, $stateProvider) {

	$stateProvider
	//.state('products.tpl.php', {
	.state('products', {
		url: '/',
		views: {
			"/:id": {
				templateUrl: '/views/product.tpl.php'
			},
			//controller: 'getInfoByProductId()',
			"/:add": {
				templateUrl: '/views/add.tpl.php'
			}
		}
	});
	
	$locationProvider.html5Mode(true);	// для того что бы использовать человекопонятные урлы
	
}]); */
////////////////////////////////////////////////////////


// Инициализируем ангуляр приложение..создаю модуль
var app = angular.module("products", ["ngRoute"]);

/**
 * Получает информацию о продукте
 * id - id продукта
 */
// Инициализируем роутинг
app.config(function($routeProvider, $locationProvider){

	$routeProvider
		.when("/:id", {
			templateUrl: "/views/product.tpl.php"
			//templateUrl: "/mvc/cabinet/cabinet/views/product.tpl.php"
		})
		/* .when("/:add", {
			templateUrl: "/views/add.tpl.php"
			//templateUrl: "/mvc/cabinet/cabinet/views/add.tpl.php"
		}) */;


	$locationProvider.html5Mode(true);	// для того что бы использовать человекопонятные урлы

});


//app.controller('productsController', function($scope, $http){
app.controller('productsController', function($scope, $http, $window){

		//$scope.myData = "abc"; // http://imagizer.imageshack.com/img923/6500/Whhe2L.jpg
	
	$scope.getInfoByProductId = function(id) {
		$http({
			method: "GET",
			//url: "http://cabinet.kamil-abzalov.ru/cabinet/products/getProduct",
			url: "http://cabinet/cabinet/products/getProduct",
			params: {id: id}
		}).then(function(result){
				//console.log(result); // http://imagizer.imageshack.com/img921/4232/gBBwgt.jpg
			// Данные буду класть в соотвествующие модели
			$scope.productId = result.data.id;
			$scope.productName = result.data.name;
			$scope.productPrice = result.data.price;
		})
	}

	$scope.saveProduct = function() {
		// TODO: Дома - добавить валидацию данных
			//console.log($scope.productName); // например, выбранный товар с айди 1  iphone8
			
		$scope.productName = angular.element("#productName").val();
        $scope.productPrice = angular.element("#productPrice").val();
			//console.log($scope.productName, $scope.productPrice); // iphone8s 33000

        $http({
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/products/saveProduct",
            url: "http://cabinet/cabinet/products/saveProduct",
            data: $.param({id: $scope.productId, name: $scope.productName, price: $scope.productPrice}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
				//console.log(result); // http://imagizer.imageshack.com/img922/2015/vsHTrP.jpg
			if(result.data.success) {
                $window.location.href = '/cabinet/products/';  // перегрузим страницу
				//$window.location.href = '/kamil/mvc/cabinet/products/';  // перегрузим страницу
				//window.location.reload(); // перегрузка окна
            }
        })
	}

	$scope.deleteProduct = function(id) {
        $http({
            method: "POST",
            //url: "http://cabinet.codetogether.ru/cabinet/products/deleteProduct",
            //url: "http://kamil/mvc/cabinet/cabinet/products/deleteProduct",
            url: "http://cabinet/cabinet/products/deleteProduct",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
                //console.log(result); // http://imagizer.imageshack.com/img922/74/JRFryy.jpg
				//$window.location.href = '/cabinet/products/';
				if(result.data.success) {
					$window.location.href = '/cabinet/products/';  // перегрузим страницу
					//$window.location.href = '/kamil/mvc/cabinet/products/';  // перегрузим страницу
				} else {
					alert("Ошибка удаления товара!");
				}
        });
    }
	
	$scope.addProduct = function() {
        // TODO: добавить валидацию данных
        $http({
            method: "POST",
            url: "http://cabinet.codetogether.ru/cabinet/products/addProduct",
			//url: "http://kamil/mvc/cabinet/cabinet/products/addProduct",
            url: "http://cabinet/cabinet/products/addProduct",
            data: $.param({productName: $scope.newProductName, productPrice: $scope.newProductPrice}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            // TODO: написать и вызвать метод получения всех продуктов
            if(result.data.success) {
                $window.location.reload();  // перегрузка окна
            }
        })

    }

});