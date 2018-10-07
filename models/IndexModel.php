<?php

// Для реализации авторизации мы должны написать метод в класс IndexModel, который будем возвращать нам false в случае некорректных логина и пароля либо перенаправит нас на главную страницу кабинета.
// Сам метод авторизации мы будем вызывать в контроллере в index методе, в случае, если массив $_POST не пуст.
class IndexModel extends Model {

	
	public function checkUser() {

		$login = $_POST['login'];
		$password = md5($_POST['password']);
		// $login = trim(strip_tags($_POST['login']));
		// $password =  md5(trim(strip_tags($_POST['password'])));

		$sql = "SELECT * FROM users WHERE login = :login AND password = :password";

		$stmt = $this->db->prepare($sql);  // PDO::prepare — Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
		$stmt->bindValue(":login", $login, PDO::PARAM_STR); // bindValue — Связывает параметр с заданным значением..строчный
		$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		$stmt->execute(); //выполняем запрос // PDOStatement::execute — Запускает подготовленный запрос на выполнение

		
		// вернется одна строка..т.е. масив из одного эл
		$res = $stmt->fetch(PDO::FETCH_ASSOC); // PDOStatement::fetch — Извлечение следующей строки из результирующего набора
			//var_dump($res); // http://picsee.net/upload/2018-02-16/6bc2f3662308.png

		if(!empty($res)) { // если не пустой
			//$_SESSION['user'] = $_POST['login']; // например: 'user' => 'john'
			$_SESSION['user'] = $login;
			$_SESSION['userId'] = $res['id'];
			$_SESSION['role_id'] = $res['role_id'];
			header("Location: /cabinet");
			//header("Location: /mvc/cabinet/cabinet");
			exit;
		} else {
			return false;
		}

	}
	
	public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
	
	public function registerNewUser($regUser, $regLogin, $regEmail, $regPassword) {
		$sql = "INSERT INTO users(fullName, login, email, password, role_id)
				VALUES (:fullName, :login, :email, :password, 2)
		"; // role_id по умолчанию менеджер

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":fullName", $regUser, PDO::PARAM_STR);
		$stmt->bindValue(":login", $regLogin, PDO::PARAM_STR);
		$stmt->bindValue(":email", $regEmail, PDO::PARAM_STR);
		$stmt->bindValue(":password", $regPassword, PDO::PARAM_STR);
		$stmt->execute();
	}

}