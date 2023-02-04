<?php
namespace Controllers;
use Views;
use Models;

class AdminController {
	protected function view_admin () {
		$view = new Views\View();
		$view->view_template('admin');
	}

	protected function get_root_check ($check_role) {
		$user_role = 0;
		if (isset($_SESSION['auth']['role'])) {
			$user_role = $_SESSION['auth']['role'];
		}
		if ($user_role < $check_role) {
			ErrorController::get_view_error(34);
			die();
		}
	}

	protected function set_changes () {
		$id = $_POST['admin_id'];
		$login = $_POST['admin_login'];
		$password = $_POST['admin_password'];
		$name = $_POST['admin_name'];
		$role = $_POST['admin_role'];
		$model = new Models\AuthModel();
		if ( ($model->get_changes($id, $login, $password, $name, $role)) ) {
			header('Location: /admin.php');
		} else {
			ErrorController::get_view_error(33);
		}
	}

	protected function set_users () {
		$model = new Models\AuthModel();
		if ( ($users = $model->get_all_users()) ) {
			session_start();
			$_SESSION['admin'] = $users;
		} else {
			ErrorController::get_view_error(32);
		}
	}

	public function get_admin_check ($role = null) {
		if ($role != null) {
			$this->get_root_check ($role);
		}
		if (isset($_POST['admin_id'])) {
			$this->set_changes();
		} elseif ($_SERVER['PHP_SELF'] == '/admin.php') {
			$this->set_users();
			$this->view_admin();
		}
	}
}