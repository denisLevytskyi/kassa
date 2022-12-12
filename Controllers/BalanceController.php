<?php
namespace Controllers;
use Views;
use Models;

class BalanceController {
	protected function view_balance () {
		ob_start();
		$data = 'Ksef/Z' . $_SESSION['balance']['timestamp'] . '.html';
		$view = new Views\View();
		$view->view_balance();
		$model = new Models\KsefModel();
		$model->get_document_registrarion($data);
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