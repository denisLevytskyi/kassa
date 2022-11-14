<?php
namespace Controllers;
use Views;
use Models;

class PriceListController {
	protected function view_price_list () {
		$view = new Views\View();
		$view->view_price_list();
	}

	protected function set_prices () {
		$model = new Models\PriceModel();
		if ( ($prices = $model->get_all_prices()) ) {
			session_start();
			$_SESSION['price_list'] = $prices;
		} else {
			ErrorController::get_view_error(20);
		}
	}

	public function get_price_list () {
		$this->set_prices();
		$this->view_price_list();
	}
}