<?php
namespace Controllers;
use Views;
use Models;

class ProductListController {
	protected function view_product_list () {
		$view = new Views\View();
		$view->view_product_list();
	}

	public function get_product_list () {
		$this->view_product_list();
	}
}