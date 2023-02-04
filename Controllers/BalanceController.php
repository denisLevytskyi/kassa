<?php
namespace Controllers;
use Views;
use Models;

class BalanceController {
	protected function view_balance () {
		ob_start();
		$data = 'Ksef/' . $_SESSION['balance']['timestamp'] . '_Z-balance_№_' . $_SESSION['balance']['id'] . '.html';
		$view = new Views\View();
		$view->view_template('balance');
		$model = new Models\KsefModel();
		$model->get_document_registration($data);
	}

	protected function set_balance_by_id () {
		$model = new Models\StaffModel();
		$id = $_GET['balance_id'];
		if ( ($balance = $model->get_balance('id', $id)) ) {
			session_start();
			$_SESSION['balance'] = $balance;
		} else {
			ErrorController::get_view_error(28);
		}
	}

	public function get_balance_check () {
		if (isset($_GET['balance_id'])) {
			$this->set_balance_by_id();
			$this->view_balance();
		} else {
			ErrorController::get_view_error(27);
		}
	}
}