<?php

// Это родительская модель, которую будут наследлвать другие модели
class Model {
	protected $db = null;

	public function __construct() {
		$this->db = DB::connToDB(); // соединяемся с БД
	}
}