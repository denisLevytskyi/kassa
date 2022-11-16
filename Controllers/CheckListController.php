<?php
namespace Controllers;
use Views;
use Models;

class CheckListController {
	protected function view_check_list () {
		$view = new Views\View();
		$view->view_check_list();
	}

	protected function set_cheks () {
		$model = new Models\CheckModel();
		if ( ($checks = $model->get_all_checks()) ) {
			session_start();
			$_SESSION['check_list'] = $checks;
		} else {
			ErrorController::get_view_error(21);
		}
	}

	public function get_check_list () {
		$this->set_cheks();
		$this->view_check_list();
	}
}