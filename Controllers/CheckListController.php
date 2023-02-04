<?php
namespace Controllers;
use Views;
use Models;

class CheckListController {
	protected function view_check_list () {
		$view = new Views\View();
		$view->view_template('checkList');
	}

	protected function set_check_by_id () {
		$model = new Models\CheckModel();
		$id = $_GET['check_id'];
		if ( ($check = $model->get_check('id', $id)) ) {
			session_start();
			$_SESSION['unika'] = array('list' => $check['main']);
			header("Location: /unika.php/");
		} else {
			ErrorController::get_view_error(23);
		}
	}

	protected function set_checks () {
		$model = new Models\CheckModel();
		if ( ($checks = $model->get_all_checks()) ) {
			session_start();
			$_SESSION['check_list'] = $checks;
		} else {
			ErrorController::get_view_error(21);
		}
	}

	public function get_check_list () {
		if (isset($_GET['check_id'])) {
			$this->set_check_by_id();
		} else {
			$this->set_checks();
			$this->view_check_list();
		}
	}
}