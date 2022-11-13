<?php
namespace Controllers;
use Views;
use Models;

class EditAuthController {
	protected function view_edit_auth () {
		$view = new Views\View();
		$view->view_edit_auth();
	}

	protected function set_changes () {
		$id = $_POST['edit_auth_id'];
		$login = $_POST['edit_auth_login'];
		$password = $_POST['edit_auth_password_1'];
		$name = $_POST['edit_auth_name'];
		$model = new Models\AuthModel();
		if ( ($model->get_chenges($id, $login, $password, $name)) ) {
			header('Location: /');
		} else {
			ErrorController::get_view_error(9);
		}
	}

	protected function set_login_by_id () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth']['id'];
		if ( ($login = $model->get_login_by_id($id)) ) {
			$_SESSION['auth']['login'] = $login;
		} else {
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
		if (empty($_POST['edit_auth_1'])) {
			$this->set_login_by_id();
			$this->view_edit_auth();
		} else {
			if ($_POST['edit_auth_password_1'] == $_POST['edit_auth_password_2']) {
				$this->set_changes();
			} else {
				ErrorController::get_view_error(8);
			}
		}
		if (isset($_GET['auth_delete'])) {
			$this->set_delete();
		}
	}
}