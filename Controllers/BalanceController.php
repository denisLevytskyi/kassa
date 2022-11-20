<?php
namespace Controllers;
use Views;
use Models;

class BalanceController {
	protected function view_balance () {
		$view = new Views\View();
		$view->view_balance();
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
