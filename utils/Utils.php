<?php
// "Этот класс может быть не только для Пейджера, а и для других каких то служебных ф-ций..ф-ций настроек приложения ..методы для какой то дополнительной функциональности, которые впринципе напрямую с даными не связаны

/**
* 1-ая - 5 продуктов
* 2-ая - с 6 по 10 продукт 
* 3-я - с 11 по 15 продукт 
* 5*(2-1)+1 = 6
* 5*(3-1)+1 = 11
* 5*(4-1)+1 = 16
* LIMIT $perPage*($page-1)+1, $itemsCount
* 15 -> 3
* 1 - 0-5
* 2 - 6- 10
* 3 - 11- 15
*/



class Utils {


	public function drawPager($totalItems, $perPage) { // totalItems - общее кол-во продуктов, perPage - кол-во продуктов на странице

		$pages = ceil($totalItems / $perPage); // считаем кол-во страниц

		if(!isset($_GET['page']) || intval($_GET['page']) == 0) {
			$page = 1;
		} else if (intval($_GET['page']) > $totalItems) { // если больше чем кол-во эл
			$page = $pages; // кол-во страниц
		} else {
			$page = intval($_GET['page']);
		}

		$pager =  "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";
        $pager .= "<li><a href='/products?page=1' aria-label='Previous'><span aria-hidden='true'>&laquo;</span> Начало</a></li>";
        for($i=2; $i<=$pages-1; $i++) {
            $pager .= "<li><a href='/products?page=". $i."'>" . $i ."</a></li>";
        }
        $pager .= "<li><a href='/products?page=". $pages ."' aria-label='Next'>Конец <span aria-hidden='true'>&raquo;</span></a></li>";
        $pager .= "</ul>";
 
        return $pager;

	}


}