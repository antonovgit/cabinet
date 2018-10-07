<?php
// В модели CabinetModel мы создадим три соответствующих метода — getOrdersCount(), getProductsCount() и getUsersCount(). Код методов идентичен за исключением названия таблицы, из которой мы получаем данные. Методы возвращают нам количество строк, а не детальные данные. Поэтому в запросе мы будем использовать функцию COUNT(). А результат мы будем получать при помощи метода fetchColumn().
class CabinetModel extends Model {

    public function getOrdersCount() {
        $sql  = "SELECT COUNT(*) FROM orders";
        $stmt = $this->db->prepare($sql); // PDO::prepare — Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $stmt->execute(); // запрос не параметризованный, поэтому не нужно байдить значения, а сразу запускаю на исполнение
        $res  = $stmt->fetchColumn(); // fetchColumn — Возвращает данные одного столбца следующей строки результирующего набора
        //return $res;
		if(empty($res)) {
			return false;
		} else {
			return $res;
		}
    }

    public function getProductsCount() {
        $sql  = "SELECT COUNT(*) FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res  = $stmt->fetchColumn();
        //return $res;
		if(empty($res)) {
			return false;
		} else {
			return $res;
		}
    }

    public function getUsersCount() {
        $sql  = "SELECT COUNT(*) FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res  = $stmt->fetchColumn();
        //return $res;
		if(empty($res)) {
			return false;
		} else {
			return $res;
		}
    }
	
	public function getOrders() {
		$sql = "SELECT
					orders.id as id,
					orders.amount as total,
					users.fullName,
					users.email
				FROM orders
				LEFT JOIN users ON users.id = orders.user_id
				";
		$result = array();
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  // PDOStatement::fetch — Извлечение следующей строки из результирующего набора..фетчим то что пришло из БД и превращаю каждую строку таблицы в ассоциативный массив
			$result[$row['id']] = $row;
		}

		//return $result;
		if(empty($result)) {
			return false;
		} else {
			return $result;
		}
	}


}

 ?>