<?php

/*
** Класс маршрутизации (Камиля)
** Урл http://cabinet.kamil-abzalov.ru/
** Урл http://cabinet.kamil-abzalov.ru/cabinet
** Урл http://cabinet.kamil-abzalov.ru/cabinet/users
** Урл http://cabinet.kamil-abzalov.ru/cabinet/orders/
** Урл http://cabinet.kamil-abzalov.ru/cabinet/orders?orderId=
*/
/*
** Класс маршрутизации (Мои)
** Урл http://kamil/mvc/cabinet/
** Урл http://kamil/mvc/cabinet/cabinet
** Урл http://kamil/mvc/cabinet/users
** Урл http://kamil/mvc/cabinet/cabinet/orders/
** Урл http://kamil/mvc/cabinet/cabinet/orders?orderId=
*/

class Routing {

	public static function buildRoute() {

		/*Контроллер и action по умолчанию*/
		$controllerName = "IndexController";
		$modelName = "IndexModel";
		$action = "index";

		/*
			// http://imagizer.imageshack.com/img921/6108/7BGhwf.png
			// parse_url -Эта функция разбирает URL и возвращает ассоциативный массив, содержащий все компоненты URL, которые в нём присутствуют. Элементы массива не будут декодированы как URL.
			При разборе значительно некорректных URL-адресов parse_url() может вернуть FALSE.

			Если параметр component будет опущен, функция возвратит ассоциативный массив (array). В массиве будет находиться по крайней мере один элемент. Возможные ключи в этом массиве:

			scheme - например, http
			host
			port
			user
			pass
			path
			query - после знака вопроса ?
			fragment - после знака решётки #
			Если параметр component определён, функция parse_url() вернёт строку (string) (или число (integer), в случае PHP_URL_PORT) вместо массива (array). Если запрошенный компонент не существует в данном URL, будет возвращён NULL.
		*/
		$route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
			//var_dump($route); // http://picsee.net/upload/2018-03-09/78282d6f3c03.png  // при http://kamil/mvc/cabinet/cabinet/pruducts
			// у Камиля http://picsee.net/upload/2018-03-09/b8de97bb0777.png
			// 0 => string '' (length=0)
			// 1 => string 'mvc' (length=3)
			// 2 => string 'cabinet' (length=7)
			// 3 => string 'cabinet' (length=7)
			// 4 => string 'products' (length=8)
		
		$i = count($route)-1; // рассматриваю массив с конца
			//echo $i; // 4 если строка http://kamil/mvc/cabinet/cabinet/products
			//echo $route[$i]; // у меня products, у Камиля пусто
			//echo $route[1]; // у меня mvc, у Камиля cabinet
			//echo $route[2]; // у меня cabinet, у Камиля products
			//echo $route[3]; // у меня cabinet, у Камиля пусто
		while($i>0) { // у Камиля
		//while($i>2) { // у меня
            if($route[$i] != '') { // если роут не равен пустой строке...у меня если $route[4]=products  не равно пустой строке
					// define("CONTROLLER_PATH", ROOT. "/controllers/");
					// ucfirst — Преобразует первый символ строки в верхний регистр
                // Если это файл(если это контролер) или если есть GET параметр // http://kamil/mvc/cabinet/cabinet/products?id=1  то products все равно останется контролером
				//if(is_file(CONTROLLER_PATH . ucfirst($route[$i]) . "Controller.php") || !empty($_GET)) { 
				if(is_file(CONTROLLER_PATH . ucfirst($route[$i]) . "Controller.php")) { 
                    $controllerName = ucfirst($route[$i]) . "Controller";
                    $modelName =  ucfirst($route[$i]) . "Model";
						//var_dump($controllerName); // ProductsController  // http://kamil/mvc/cabinet/cabinet/products
						//var_dump($modelName); // ProductsModel			// http://kamil/mvc/cabinet/cabinet/products
						//var_dump($controllerName); // CabinetController	    // http://kamil/mvc/cabinet/cabinet/products/cabinet
						//var_dump($modelName);	// CabinetModel             // http://kamil/mvc/cabinet/cabinet/products/cabinet
                    break;
                } else { // если это не контролер
                    $action = $route[$i];
                }
            }
            $i--;
        }
		
		require_once CONTROLLER_PATH . $controllerName . ".php"; //IndexController.php
		require_once MODEL_PATH . $modelName . ".php"; //IndexModel.php

        $controller = new $controllerName();
		$controller->$action(); // запускаем метод (либо метод по умолчанию, либо тот, что мы определили)
		
		
		// /////////////////////////////////////////////////////////////////////
		// // Было до рефакторинга
		// //$route = explode("/", $_SERVER['REQUEST_URI']); // $_SERVER['REQUEST_URI']  это   /mvc/cabinet/conf/route.php
			// //var_dump($route); // http://picsee.net/upload/2018-02-15/aed6aa566813.png
		
		// /*Определяем контроллер*/
		// if($route[3] != '') { // если у нас есть контролер, т.е. если первая часть не пустая
			// $controllerName = ucfirst($route[3]. "Controller"); // ucfirst — Преобразует первый символ строки в верхний регистр
			// $modelName = ucfirst($route[3]. "Model");
		// }
		// // if($route[1] != '') { // если у нас есть контролер, т.е. если первая часть не пустая
			// // $controllerName = ucfirst($route[1]. "Controller"); // ucfirst — Преобразует первый символ строки в верхний регистр
			// // $modelName = ucfirst($route[1]. "Model");
		// // }
		
		// // Подключаем контролер и модель
		// //var_dump(CONTROLLER_PATH); // C:/Users/valerchik/Downloads/Lesson/open_server/OpenServer/domains/kamil/mvc/cabinet/controllers/
		// //var_dump($controllerName); // IndexController
		// require_once CONTROLLER_PATH . $controllerName . ".php"; //IndexController.php
		// require_once MODEL_PATH . $modelName . ".php"; //IndexModel.php

		// if(isset($route[4]) && $route[4] !='') { // если экшен есть и если он не пустой
			// $action = $route[4];
		// }
		// // if(isset($route[2]) && $route[2] !='') {
			// // $action = $route[2];
		// // }

		// // Нужно запустить экшен. Этот экшен будет находиться в каком то определенном контролере(либо IndexController.php по умолчанию, либо тот, что мы определили)..а контроллер это клас и прежде чем запустить контроллер нам нужно создать объект класса, т.е. объект контроллера
		// $controller = new $controllerName();
		// $controller->$action(); // $controller->index(); // запускаем метод (либо метод по умолчанию, либо тот, что мы определили)
		// ///////////////////////////////////////////////////////////////////////////////
	}

	// Что бы без авторизации не моли видеть страницу кабинета..этот метод будет отображать 404 страницу если мы попытаемся напрямую зайти на адрес: http://kamil/mvc/cabinet/
	public function errorPage() {

	}


}
