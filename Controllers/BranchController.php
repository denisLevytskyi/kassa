<?php
namespace Controllers;
use Views;
use Models;

class BranchController {
	protected function view_branch () {
		ob_start();
		$data = 'Ksef/' . $_SESSION['branch']['timestamp'] . '_Branch_№_' . $_SESSION['branch']['id'] . '.html';
		$view = new Views\View();
		$view->view_branch();
		$model = new Models\KsefModel();
		$model->get_document_registration($data);
	}

	protected function set_branch_by_id () {
		$model = new Models\StaffModel();
		$id = $_GET['branch_id'];
		if ( ($branch = $model->get_branch('id', $id)) ) {
			session_start();
			$_SESSION['branch'] = $branch;
		} else {
			ErrorController::get_view_error(26);
		}
	}

	public function get_branch_check () {
		if (isset($_GET['branch_id'])) {
			$this->set_branch_by_id();
			$this->view_branch();
		} else {
			ErrorController::get_view_error(25);
		}
	}
}
