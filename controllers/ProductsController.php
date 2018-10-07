<?php
// http://kamil/mvc/cabinet/cabinet/products

class ProductsController extends Controller {

    private $pageTpl = "/views/products.tpl.php";
	private $productsPerPage = 5;

    public function __construct() {
        $this->model = new ProductsModel(); // подцепляем модель для данного контроллера
        $this->view  = new View(); // подцепляем вьюху
		$this->utils = new Utils(); // подключаю пейджер
    }

    public function index() {
        //echo 1;
		
		if(!$_SESSION['user']) { // если не авторизован
            header("Location: /");
            //header("Location: /mvc/cabinet/");
        }
		$allProducts = count($this->model->getAllProducts()); // получаю кол-во всех продуктов
        $totalPages = ceil($allProducts / $this->productsPerPage);

        $this->makeProductPager($allProducts, $totalPages);

        $pagination = $this->utils->drawPager($allProducts, $this->productsPerPage); // отрисуем пагинацию

        $this->pageData['pagination'] = $pagination;
        $this->pageData['title'] = "Товары";
        // $this->pageData['productsOnPage'] = $this->model->getAllProducts();

        //$this->pageData['products'] = $this->model->getAllProducts(); // передаем во вьюху товары
        //$this->pageData['title'] = "Товары";
        $this->view->render($this->pageTpl, $this->pageData);
			// При загрузке файлов надо обращать внимание на размер файла и время исполнения скрипта
			//var_dump($_FILES); // http://imagizer.imageshack.com/img923/9681/oo2PK1.png

        if($_FILES) {
            //if($_FILES['csv']['type'] != 'text/csv' || $_FILES['csv']['type'] == '') { // если тип не установлен или тип пусто
            if($_FILES['csv']['type'] != 'application/vnd.ms-excel' || $_FILES['csv']['type'] == '') {
                $this->pageData['errors'] = "Ошибка! Возможно данный файл имеет некорректный формат";
            } else {
                if(move_uploaded_file($_FILES['csv']['tmp_name'],UPLOAD_FOLDER.$_FILES['csv']['name'])) {
                    $file = fopen(UPLOAD_FOLDER.$_FILES['csv']['name'], "r"); // открываем файл для чтения
							//var_dump($file); // resource(13, stream) // http://imagizer.imageshack.com/img923/5069/AuJGi5.png
							//$data = fgetcsv($file, 200, ";");
							//var_dump($data); // http://imagizer.imageshack.com/img924/694/CrS7l8.jpg
					$row = 1; // что бы перепрыгнуть строчку
                    while($data = fgetcsv($file, 200, ";")) { // fgetcsv что бы прочитать данные из файла csv..$file - ресурс связанный с открым файлом..200 ограничиваем длину одной строки..";" - ограничитель
							//var_dump($data); // http://imagizer.imageshack.com/img922/2495/wKwhhe.jpg
						if($row == 1) {
                            $row++;
                            continue;
                        } else {
                            $this->model->addFromCSV($data);
                        }
                    }
                    fclose($file);
                    $this->model->getAllProducts();  // получаем список всех товаров
                }
            }
        }
    }
	
	public function getProduct() {
			//echo 1;
		if(!$_SESSION['user']) { // если не авторизован
			header("Location: /");
			//header("Location: /mvc/cabinet/");
			return;
		}

		if(!isset($_GET['id'])) { // если в параметр ГЕТ я не передал айдишку, то я должен выдать ошибку
			echo json_encode(array("success" => false));
		} else { //  если все в порядке
			$productId = $_GET['id']; // принимаем айди
			$produtInfo = json_encode($this->model->getProductById($productId));
			echo $produtInfo;
		}
	}
	
	public function saveProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
			//header("Location: /mvc/cabinet/");
            return;
        }

        // если из ПОСТА не пришел айди, или тейм и прайс пусто, то я должен выдать ошибку
		if(!isset($_POST['id']) || trim($_POST['name']) == '' || trim($_POST['price']) == '') {
            echo json_encode(array("success" => false));
        } else {  //  если все в порядке
            $productId = $_POST['id'];
            $productName = trim($_POST['name']);
            $productPrice = trim($_POST['price']);

            if($this->model->saveProductInfo($productId, $productName, $productPrice)) {
                echo json_encode(array("success" => true)); // если все завершилось корректно
            } else {
                echo json_encode(array("success" => false));
            }
        }
    }
	
	public function deleteProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
			//header("Location: /mvc/cabinet/");
            return;
        }

        if(empty($_POST) || !isset($_POST['id'])) { // если ПОСТ путой или не пришел нам айди, то я должен выдать ошибку
            echo json_encode(array("success" => false));
        } else {
            $productId = $_POST['id'];
            if($this->model->deleteProduct($productId)) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false));
            }
        }
    }
	
	public function addProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
			//header("Location: /mvc/cabinet/");
            return;
        }

        if(empty($_POST) || trim($_POST['productName']) == '' || trim($_POST['productPrice']) == '') {
            echo json_encode(array("success" => false));
        } else {
            $productName = trim($_POST['productName']);
            $productPrice = trim($_POST['productPrice']);

            if($this->model->addProduct($productName, $productPrice)) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false));
            }
        }
    }
	
	// Выводит на странице товары..делает выборку по кол-ву товаров, которое мы ей укажем
	public function makeProductPager($allProducts, $totalPages) { // все продукты и общее кол-во страниц

        // если не установлена страница или если она равна 0 или 1 или меньше 0
		if(!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1; // номер страницы будет равен 1
            $leftLimit = 0; // а левый лимит равен 0, т.е. я буду выбирать с самого первого товара
            $rightLimit = $this->productsPerPage; // 0-5  // а правый лимит буду выбирать с 0 до 5..первые 5 товаров
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages; // 2  // текущий номер страницы присваиваю общему кол-ву, в данном случае 2
            $leftLimit = $this->productsPerPage * ($pageNumber - 1); // 5 * (2-1) = 6
            $rightLimit = $allProducts; // 8
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $this->productsPerPage * ($pageNumber-1); // 5* (2-1) = 6
            $rightLimit = $this->productsPerPage; // 5 -> (6,7,8,9,10)  // 5 это количкество от левого лимита
        }

        $this->pageData['productsOnPage'] = $this->model->getLimitProducts($leftLimit, $rightLimit);

    }
	

}
