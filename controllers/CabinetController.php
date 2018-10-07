<?php
// В контроллере мы как всегда объявляем приватное свойство — шаблон для отрисовки, а также метод по умолчанию (index), который будет отрисовывать страницу с некоторыми данными, которые хранятся в массиве pageData. Для начала мы выведем на страницу небольшую общую статистику — количество заказов, товаров и пользователей.
// Для этого в модели CabinetModel мы создадим три соответствующих метода — getOrdersCount(), getProductsCount() и getUsersCount(). Код методов идентичен за исключением названия таблицы, из которой мы получаем данные. Методы возвращают нам количество строк, а не детальные данные. Поэтому в запросе мы будем использовать функцию COUNT(). А результат мы будем получать при помощи метода fetchColumn().
class CabinetController extends Controller {

    private $pageTpl = "/views/cabinet.tpl.php";

    public function __construct() {
        $this->model = new CabinetModel(); // подцепляем модель для данного контроллера
        $this->view  = new View(); // подцепляем вьюху
    }

    public function index() {
        
		//var_dump($_SESSION); // http://picsee.net/upload/2018-02-16/e0d3e78ea845.png
		//if(!$_SESSION['user']) { // если в массиве сессий нет индекса юзер
		if(!isset($_SESSION['user'])) { // если в массиве сессий нет индекса юзер
			header("Location: /");
			//header("Location: /mvc/cabinet/");
			/* $D_R = "C:/Users/valerchik/Downloads/Lesson/open_server/OpenServer/domains/kamil/mvc/cabinet";
			header("Location: $D_R"); */
			exit;
		}
		$this->pageData['title'] = "Кабинет";

        $ordersCount = $this->model->getOrdersCount(); // вызываем соответствующую модель и дергаем ее метод getOrdersCount
        $this->pageData['ordersCount'] = $ordersCount; // в массив поместил количесто заказов в БД

        $productsCount = $this->model->getProductsCount();
        $this->pageData['productsCount'] = $productsCount;

        $usersCount = $this->model->getUsersCount();
        $this->pageData['usersCount'] = $usersCount;

		$orders = $this->model->getOrders();
		$this->pageData['orders'] = $orders;
		
        $this->view->render($this->pageTpl, $this->pageData); //отрисовываем, передаю шаблон страницы и массив pageData
    }
	
	public function logout() {
		session_destroy();  //!не удаляет файл, а очищает файл	//Уничтожает все данные, зарегистрированные на сессии
		header("Location: /");
		//header("Location: /mvc/cabinet/");
		exit;
	}

}

 ?>