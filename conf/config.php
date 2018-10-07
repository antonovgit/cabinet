<?php

session_start();

// В конфигурационном файле мы определим общие для всего приложения константы, а также подключим общие файлы (модель, контроллер и представление, класс соединения с базой данных и роутинг) и запустим метод определения маршрута (URL) приложения (см код conf.php).

//echo $_SERVER['DOCUMENT_ROOT']; // C:/Users/valerchik/Downloads/Lesson/open_server/OpenServer/domains/kamil
// К $_SERVER['DOCUMENT_ROOT'] нужно добавить /mvc/cabinet что бы получить http://kamil/mvc/cabinet
	//define("ROOT", "/var/www/u0016495/data/www/cabinet.kamil-abzalov.ru");
//$_SERVER['DOCUMENT_ROOT'] = "C:/Users/valerchik/Downloads/Lesson/open_server/OpenServer/domains/kamil/mvc/cabinet";
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
//$D_R = "C:/Users/valerchik/Downloads/Lesson/open_server/OpenServer/domains/kamil/mvc/cabinet";
//define("ROOT", $D_R);
//define("ROOT", $_SERVER['DOCUMENT_ROOT']. "/mvc/cabinet");
define("CONTROLLER_PATH", ROOT. "/controllers/");
define("MODEL_PATH", ROOT. "/models/");
define("VIEW_PATH", ROOT. "/views/");
// echo VIEW_PATH; // C:/Users/valerchik/Downloads/Lesson/open_server/OpenServer/domains/kamil/mvc/cabinet/views/
define("UPLOAD_FOLDER", ROOT. "/uploads/");
define("UTILS", ROOT. "/utils/");


// echo $_SERVER['REQUEST_URI']; // /mvc/cabinet/conf/config.php
// $segments = explode('/', $_SERVER['REQUEST_URI']); // бьем строку по '/' и получаем массив строк ['', 'mvc', 'cabinet',...]
// var_dump($segments); // http://picsee.net/upload/2018-02-15/4fdc3c2ebbdb.png
// var_dump($segments[0]); // string '' (length=0)
// var_dump($segments[1]); // string 'mvc' (length=3)
// var_dump($segments[2]); // string 'cabinet' (length=7)

	// // // Определяем какой контроллер
	// // /* $controllerName = array_shift($segments) . 'Controller';
	// // echo $controllerName; // Controller */
// $controllerName = array_splice($segments, 2);
// var_dump($controllerName); // http://picsee.net/upload/2018-02-15/c25fb8380ceb.png
// var_dump($segments); // http://picsee.net/upload/2018-02-15/ee45344027e5.png

// // $input = array("red", "green", "blue", "yellow");
// // array_splice($input, 2);
// // // $input is now array("red", "green")

require_once("db.php");
require_once("route.php");
require_once UTILS . "Utils.php";
require_once MODEL_PATH. 'Model.php';
require_once VIEW_PATH. 'View.php';
require_once CONTROLLER_PATH. 'Controller.php';


Routing::buildRoute(); // запускаем сам роутинг (класс Routing и мего метод buildRoute())