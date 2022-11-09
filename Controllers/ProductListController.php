<?php
namespace Controllers;
use Views;
use Models;

class ProductListController {
	protected function view_product_list () {
		$view = new Views\View();
		$view->view_product_list();
	}

	protected function get_products () {
		$model = new Models\ProductModel();
		if ( ($products = $model->get_all_products()) ) {
			session_start();
			$_SESSION['product_list'] = $products;
		} else {
			ErrorController::get_view_error(12);
		}
	}

	public function get_product_list () {
		$this->get_products();
		$this->view_product_list();
	}
}