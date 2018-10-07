<?php

class OrdersModel extends Model {

	public function getOrderInfoByOrderId($orderId) {
		$result = array();
		$sql = "SELECT users.fullName, users.email, orders.amount, products.name, products.price 
				FROM users 
				INNER JOIN orders ON orders.user_id = users.id 
				INNER JOIN productsInOrders ON orders.id = productsInOrders.order_id 
				INNER JOIN products ON productsInOrders.product_id = products.id 
				WHERE orders.id = :orderId";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":orderId", $orderId, PDO::PARAM_INT);
		$stmt->execute();
		//$result = $stmt->fetchAll();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // http://imagizer.imageshack.com/img921/9006/hBzMFN.jpg
		//return $result;
		if(empty($result)) {
			return false;
		} else {
			return $result;
		}

	}
	
	public function deleteOrder($orderId) {
        // Удалять нужно из двух таблиц, потому что у нас есть связи между таблицами - заказ связан с продуктами..не могу удалить заказ в котором есть какие то продукты. Поэтому надо выполнить два запроса
		$sql = "DELETE FROM productsInOrders WHERE order_id = :orderId;
                DELETE FROM orders WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderId", $orderId, PDO::PARAM_INT);
        $stmt->bindValue(":id", $orderId, PDO::PARAM_INT);
        $stmt->execute();      
    }

}