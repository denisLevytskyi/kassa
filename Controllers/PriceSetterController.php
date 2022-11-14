<?php
namespace Controllers;
use Views;
use Models;

class PriceSetterController {
	protected function view_price_setter () {
		$view = new Views\View();
		$view->view_price_setter();
	}

	protected function set_new_price () {
		$art = $_POST['price_setter_article'];
		$price = $_POST['price_setter_price'] * 100;
		$time = time();
		$id = $_SESSION['auth']['id'];
		$model = new Models\PriceModel();
		if ( ($model->get_price_registration($art, $price, $time, $id)) ) {
			header("Location: /priceSetter.php", true, 303);
		} else {
			ErrorController::get_view_error(19);
		}
	}

	public function get_price_setter () {
		if (empty($_POST['price_setter_article'])) {
			$this->view_price_setter();
		} else {
			$this->set_new_price();
		}
	}
}