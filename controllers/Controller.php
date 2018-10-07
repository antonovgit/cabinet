<?php

// Родительский класс. В нем будут совершаться какие то общие действия для всех контролеров
class Controller {

	public $model;
	public $view;
	protected $pageData = array(); // что бы во вьюхе выводить какие то динамические данные(тайтл)

	public function __construct() {
		$this->view = new View(); // создаем новую вьюху
		$this->model = new Model(); // создаем новую модель
	}	

}