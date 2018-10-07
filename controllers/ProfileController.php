<?php


class ProfileController extends Controller {


	private $pageTpl = "/views/profile.tpl.php";

	public function __construct() {
		$this->model = new ProfileModel();
		$this->view = new View();
	}

	public function index() {
		if(!$_SESSION['user']) {
			//header("Location: /mvc/cabinet/");
			header("Location: /");
		}

		//$userId = $_SESSION['userId'];
		$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
			//var_dump($userId); // 1
			//var_dump($_SESSION); // http://imagizer.imageshack.com/img923/5673/7pXNIz.jpg
		$userInfo = $this->model->getAccountInfo($userId);  // положим данные из модели
			//var_dump($userInfo); // http://imagizer.imageshack.com/img924/8640/I1U3n8.jpg
		$this->pageData['userInfo'] = $userInfo;
		$this->pageData['title'] = "Мой аккаунт";
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function updateProfile() {
		if(!$_SESSION['user']) {
			header("Location: /");
			//header("Location: /mvc/cabinet/");
		}

		if(empty($_POST) || !isset($_POST['login']) || !isset($_POST['email'])) {
			echo json_encode(array("success" => false, "text" => "Введите все данные"));
		} else {
			$profileId = $_POST['id'];
			$profileLogin = strip_tags(trim($_POST['login']));
			$profileEmail = strip_tags(trim($_POST['email']));
			if($this->model->updateProfile($profileId, $profileLogin, $profileEmail)) {
				echo json_encode(array("success" => true));
			} else {
				echo json_encode(array("success" => false, "text" => "Ошибка при обновлении"));
			}
		}		
	}

	public function updatePassword() {
		if(!$_SESSION['user']) {
			header("Location: /");
			//header("Location: /mvc/cabinet/");
		}

		if(empty($_POST) || !isset($_POST['newpass']) || !isset($_POST['repeatpass'])) {
			echo json_encode(array("success" => false, "text" => "Ошибка ввода пароля"));
		} else {
			$profileId = $_POST['id'];
			$newPass = strip_tags(trim($_POST['newpass']));
			$repeatPass = strip_tags(trim($_POST['repeatpass']));

			if($newPass != $repeatPass) {
				echo json_encode(array("success" => false, "text" => "Пароли не совпадают"));
			} else {
				if($this->model->updatePassword($profileId, md5($newPass))) {
					echo json_encode(array("success" => true));
				} else {
					echo json_encode(array("success" => false, "text" => "Ошибка"));
				}
			}

		}		
	}

}