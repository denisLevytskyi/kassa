<?php
namespace Controllers;
use Views;
use Models;

class EditAuthController {
	protected function view_error7() {
		session_start();
		$_SESSION['error'] = 7;
		$_SESSION['error_desc'] = 'No login for this id!';
		header('Location: /error.php');
	}

	protected function view_error8() {
		session_start();
		$_SESSION['error'] = 8;
		$_SESSION['error_desc'] = "New passwords didn't match!";
		header('Location: /error.php');
	}

	protected function view_error9() {
		session_start();
		$_SESSION['error'] = 9;
		$_SESSION['error_desc'] = "Problems with data entry! (CHANGES)";
		header('Location: /error.php');
	}

	protected function view_error10() {
		session_start();
		$_SESSION['error'] = 10;
		$_SESSION['error_desc'] = "Problems with data entry! (DELETE)";
		header('Location: /error.php');
	}

	protected function view_edit_auth () {
		$view = new Views\View();
		$view->view_edit_auth();
	}

	protected function set_changes () {
		$id = $_POST['edit_auth_id'];;
		$login = $_POST['edit_auth_login'];
		$password = $_POST['edit_auth_password_1'];
		$name = $_POST['edit_auth_name'];
		$model = new Models\AuthModel();
		if ( ($model->get_chenges($id, $login, $password, $name)) ) {
			header('Location: /');
		} else {
			$this->view_error9();
		}
	}

	protected function set_login_by_id () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth_id'];
		if ( ($login = $model->get_login_by_id($id)) ) {
			$_SESSION['auth_login'] = $login;
		} else {
			$this->view_error7();
		}
	}

	protected function set_delete () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth_id'];
		if ( ($model->get_delete($id)) ) {
			header('Location: /?disconnect=1');
		} else {
			$this->view_error10();
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
				$this->view_error8();
			}
		}
		if (isset($_GET['delete'])) {
			$this->set_delete();
		}
	}
}