<?php
namespace Controllers;
use Views;
use Models;

class EditAuthController {
	protected function view_edit_auth () {
		$view = new Views\View();
		$view->view_template('editAuth');
	}

	protected function set_changes () {
		$id = $_POST['edit_auth_id'];
		$login = $_POST['edit_auth_login'];
		$password = $_POST['edit_auth_password_1'];
		$name = $_POST['edit_auth_name'];
		$role = $_SESSION['auth']['role'];
		$model = new Models\AuthModel();
		if ( ($model->get_changes($id, $login, $password, $name, $role)) ) {
			header('Location: /');
		} else {
			ErrorController::get_view_error(9);
		}
	}

	protected function set_login_check () {
		if (empty($_SESSION['auth']['login'])) {
			ErrorController::get_view_error(7);
		}
	}

	protected function set_delete () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth']['id'];
		if ( ($model->get_delete($id)) ) {
			header('Location: /?auth_disconnect=1');
		} else {
			ErrorController::get_view_error(10);
		}
	}

	public function get_edit_auth_check () {
		if (isset($_GET['auth_delete'])) {
			$this->set_delete();
		} elseif (empty($_POST['edit_auth_id'])) {
			$this->set_login_check();
			$this->view_edit_auth();
		} elseif ($_POST['edit_auth_password_1'] == $_POST['edit_auth_password_2']) {
			$this->set_changes();
		} else {
			ErrorController::get_view_error(8);
		}
	}
}