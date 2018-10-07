<?php


class OrdersController extends Controller {


	private $pageTpl = "/views/order.tpl.php";
	private $mailTpl = "/views/mail/checkOrder.tpl.html";


	public function __construct() {
		$this->model = new OrdersModel(); // инициализируем модель
		$this->view = new View();         // и вьюху
	}
	
	/*//>Список заказов нужно поместить внутрь тела HTML. Тогда в шаблоне письма с подтверждением заказа (файл checkOrder.tpl.html) в конце сообщения необходимо вставить закладку вида – %theList%. А в файле OrdersController.php модернизировать код вставки перечня заказанных товаров.
		$theList = "<ul style='margin:0; padding:0'>";
		for($i=0; $i<count($products); $i++) {
			$theList .= "<li>" . $products[$i] . " - " . $prices[$i] . "</li>";
		}
		$theList .= "</ul>";
		$emailText = str_replace('%theList%', $theList, $emailText);
		
	//< Здравствуйте. Спасибо за вашу рекомендацию. В принципе  ваша реализация проще моей.
	*/
	public function sendCheckOrderMail($fullName, $email, $amount, $products, $prices) {
		if(!$_SESSION['user']) {
			header("Location: /");
		}
        
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $emailText = file_get_contents(ROOT . $this->mailTpl);
        $emailText = str_replace('%fullName%', $fullName, $emailText);
        $emailText = str_replace('%amount%', $amount, $emailText);
        $emailText .= "<ul style='margin:0; padding:0'>";
        $arr = count($products);
		//for($i=0; $i<count($products); $i++) {
		for($i=0; $i<$arr; $i++) {
            $emailText .= "<li>" . $products[$i] . " - " . $prices[$i] . "</li>";
        }
        $emailText .= "</ul>";

        mail($email, "Ваш заказ одобрен", $emailText, $headers);

    }


	public function index() {
		if(!$_SESSION['user']) {
			header("Location: /");
		}

		$this->pageData['title'] = "Детали заказа";
		if(isset($_GET['orderId'])) { // если передали в ГЕТ параметре orderId
			$orderId = $_GET['orderId'];
			$this->pageData['orderInfo'] = $this->model->getOrderInfoByOrderId($orderId); // беру из модели информацию о заказе кладу в массив
		}
		$this->view->render($this->pageTpl, $this->pageData);
	}
	
	public function checkOrder() {
        if(!$_SESSION['user']) {
			header("Location: /");
		}
		
		if(isset($_POST['id'])) {
            $orderId = $_POST['id'];
            $orderInfo = $this->model->getOrderInfoByOrderId($orderId); // берем модель
            // берем необходимые данные для письма
			$fullName = $orderInfo[0]['fullName'];
            $email = $orderInfo[0]['email'];
            $amount = $orderInfo[0]['amount'];
            $productsArr = array(); // будем сюда складывать продукты ..для письма
            $productsPricesArr = array(); // сюда будем складывать цены ..для письма
            foreach($orderInfo as $item) {
                array_unshift($productsArr, $item['name']); // помещаю в начало массива productsArr мой продукт $item['name']
                array_unshift($productsPricesArr, $item['price']);
            }
            $this->sendCheckOrderMail($fullName, $email, $amount, $productsArr, $productsPricesArr);
            echo json_encode(array("success" => true, "text" => "Заказ одобрен"));
        } else { // если айди не пришел в ПОСТе
            echo json_encode(array("success" => false, "text" => "Ошибка"));
        }
    }

    public function deleteOrder() {
        if(!$_SESSION['user']) {
			header("Location: /");
		}
		
		if(isset($_POST['id'])) {
            $orderId = $_POST['id'];
            $this->model->deleteOrder($orderId);
            echo json_encode(array("success" => true, "text" => "Заказ удален"));
        } else {
            echo json_encode(array("success" => false, "text" => "Не удалось удалить заказ"));
        }
    }


}
