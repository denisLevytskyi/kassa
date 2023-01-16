<?php
namespace Controllers;
use Views;
use Models;

class CheckController {
	protected function view_check () {
		ob_start();
		$data = 'Ksef/' . $_SESSION['check']['timestamp'] . '_Check_№_' . $_SESSION['check']['id'] . '.html';
		$view = new Views\View();
		$view->view_check();
		$model = new Models\KsefModel();
		$model->get_document_registration($data);
	}

	protected function set_check_by_data () {
		$model = new Models\CheckModel();
		$code = $_GET['check_data'];
		$search_p = 'sum';
		if ($code[0] == '*') {
			$search_p = 'id';
			$code = trim($code, '*');
		}
		if ( ($check = $model->get_check($search_p, $code)) ) {
			session_start();
			$_SESSION['check'] = $check;
		} else {
			ErrorController::get_view_error(23);
		}
	}

	protected function set_check_by_id () {
		$model = new Models\CheckModel();
		$id = $_GET['check_id'];
		if ( ($check = $model->get_check('id', $id)) ) {
			session_start();
			$_SESSION['check'] = $check;
		} else {
			ErrorController::get_view_error(23);
		}
	}

	public function get_check () {
		if (isset($_GET['check_id'])) {
			$this->set_check_by_id();
			$this->view_check();
		} elseif (isset($_GET['check_data'])) {
			$this->set_check_by_data();
			$this->view_check();
		} else {
			ErrorController::get_view_error(22);
		}
	}
}