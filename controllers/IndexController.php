<?php

//В IndexController мы определим indexAction() метод, в котором запустим метод класса View — render(). Этот метод отрисовывает html в браузер, принимая два параметра — шаблон для отрисовки и массив с динамически данными страницы — заголовок страницы, сообщения и прочее.
// Отслеживает действия на главной странице
class IndexController extends Controller {

	private $pageTpl = '/views/main.tpl.php';


	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}

	
	// Сам метод авторизации мы будем вызывать в контроллере в index методе, в случае, если массив $_POST не пуст.
	/* public function index() {
		// $this->pageData['title'] = "Вход в личный кабинет";
		// $this->view->render($this->pageTpl, $this->pageData); //передаю шаблон страницы и массив pageData
			//var_dump($_POST); // http://picsee.net/upload/2018-02-16/460ed74d48c6.png
		
		$this->pageData['title'] = "Вход в личный кабинет";
		if(!empty($_POST)) {
			if(!$this->login()) { // если логин вернул фолс
				$this->pageData['error'] = "Неправильный логин или пароль";
			}
		}

		$this->view->render($this->pageTpl, $this->pageData); //отрисовываем, передаю шаблон страницы и массив pageData
	} */
	public function index() {
		$this->pageData['title'] = "Вход в личный кабинет";
			//var_dump($_POST); // http://imagizer.imageshack.com/img922/6311/L5nwca.jpg
		if(!empty($_POST)) {
			$action = $_POST['action'];
			switch ($action) {
				case 'login':
					if(!$this->login()) {
						$this->pageData['loginError'] = "Неправильный логин или пароль";
					}
					break;
				
				case 'register':
					if($this->register()) {
						$this->pageData['registerMsg'] = "Вы успешно зарегистрированы. Пожалуйста, авторизуйтесь";
					} else {
						$this->pageData['registerMsg'] = "Произошла ошибка во время регистрации";
					}
					break;
			}
		}

		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function login() {
		if(!$this->model->checkUser()) { // если вернуло значение фолс
			return false;
		}
	}
	
	public function register() {
			//var_dump($_POST); // http://imagizer.imageshack.com/img921/7311/740Asp.jpg
		if(!empty($_POST) && !empty($_POST['fullName']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
			$regUser = $_POST['fullName'];
			$regLogin = $_POST['login'];
			$regEmail = $_POST['email'];
			$regPassword = md5($_POST['password']);
			$this->model->registerNewUser($regUser, $regLogin, $regEmail, $regPassword);
			return true;
		} else {
			$this->pageData['registerMsg'] = "Вы заполнили не все поля";
			return false;
		}
	}
	

}