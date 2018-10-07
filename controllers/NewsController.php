<?php

class NewsController extends Controller {

	private $pageTpl = '/views/news.tpl.php';

	public function __construct() {
		$this->model = new NewsModel();
		$this->view = new View();
	}

	public function index() {
		if(!$_SESSION['user']) {
			header("Location: /");
		}

		$this->pageData['title'] = "Новости";

		$news = $this->model->getNews();
		$this->pageData['news'] = $news;

		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function getNewsById() {
		if(!$_SESSION['user']) {
			header("Location: /");
		}

		if(isset($_POST['id'])) {
			$newsId = $_POST['id'];
			if($newsInfo = $this->model->getNewsById($newsId)) {
				echo json_encode($newsInfo);
			} else {
				echo json_encode(array("success" => false, "text" => "Новость не найдена"));
			}
		} else { // если айдишник не пришел
			echo json_encode(array("success" => false, "text" => "Ошибка"));
		}
	}

	public function save() {
		if(!$_SESSION['user']) {
			header("Location: /");
		}

		if(!empty($_POST) && !empty($_POST['title']) && !empty($_POST['text'])) {
			//$newsId = abs(int($_POST['id']));
			$newsId = strip_tags(trim($_POST['id']));
			$newsTitle = strip_tags(trim($_POST['title']));
			$newsText = strip_tags(trim($_POST['text']));
			$this->model->saveNews($newsId, $newsTitle, $newsText);
			echo json_encode(array("success" => true, "text" => "Новость сохранена"));
		} else {
			echo json_encode(array("success" => false, "text" => "Ошибка"));
		}
	}

}