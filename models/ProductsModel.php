<?php
// http://kamil/mvc/cabinet/cabinet/products

class ProductsModel extends Model {

	public function getAllProducts() { // получаем список всех товаров
        $result = array();
        $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        //return $result;
		if(empty($result)) {
			return false;
		} else {
			return $result;
		}
    }
	
	// делает выборку по кол-ву товаров, которое мы ей укажем
	public function getLimitProducts($leftLimit, $rightLimit) {
        $result = array();
        $sql = "SELECT * FROM products LIMIT :leftLimit, :rightLimit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":leftLimit", $leftLimit, PDO::PARAM_INT);
        $stmt->bindValue(":rightLimit", $rightLimit, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        //return $result;
		if(empty($result)) {
			return false;
		} else {
			return $result;
		}

    }

    // эту ф-цию циклически мы вызываем в контролере..каждый раз когда мы читаем строку из файла, у нас будет выполнятся ровно один запрос
	public function addFromCSV($data) {
        $sql = "INSERT INTO products(name, price) VALUES(:name, :price)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $data[0], PDO::PARAM_STR);  // название товара
        $stmt->bindValue(":price", $data[1], PDO::PARAM_INT); // цена товара
        $stmt->execute();

    }
	
	public function getProductById($id) {
		$result = array();
		
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
		//return $result;
		if(empty($result)) {
			return false;
		} else {
			return $result;
		}
	}
	
	public function saveProductInfo($id, $name, $price) {
        $sql = "UPDATE products
                SET price = :price, name = :name
                WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
	
	public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount(); // PDOStatement::rowCount — Возвращает количество строк, затронутых последним SQL-запросом
        if($count > 0) { // если были каки то строки удалены
            return true;
        } else {
            return false;
        }

    }
	
	public function addProduct($productName, $productPrice) {
        $sql = "INSERT INTO products(name, price)
                VALUES(:productName, :productPrice)
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productName", $productName, PDO::PARAM_STR);
        $stmt->bindValue(":productPrice", $productPrice, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }


}