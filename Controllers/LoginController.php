<?php
namespace Controllers;
use Views;
use Models;

class LoginController {
	protected function view_login () {
		$view = new Views\View();
		$view->view_login();
	}

	protected function view_main () {
		$view = new Views\View();
		$view->view_main();
	}

	protected function set_id ($remember = false) {
		$model = new Models\AuthModel();
		$login = $_POST['login_login'];
		$password = $_POST['login_password'];
		if ( ($id = $model->get_user_data('login', $login, 'password', $password, 'id')) ) {
			if ($remember) {
				setcookie('auth_id', $id, time() + 10000);
			}
			$_SESSION['auth']['id'] = $id;
		} else {
			ErrorController::get_view_error(1);
		}
	}

	protected function set_name_by_id () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth']['id'];
		if ( ($name = $model->get_user_data('id', $id, 'id', $id, 'name')) ) {
			$_SESSION['auth']['name'] = $name;
		} else {
			$this->set_disconnect();
			ErrorController::get_view_error(6);
		}
	}

	protected function get_main_check () {
		if (isset($_SESSION['auth']['id'])) {
			$this->set_name_by_id();
			$this->view_main();
		} elseif (isset($_COOKIE['auth_id'])) {
			$_SESSION['auth']['id'] = $_COOKIE['auth_id'];
			$this->set_name_by_id();
			$this->view_main();
		} else {
			$this->view_login();
		}
	}

	protected function get_other_check () {
		if (isset($_COOKIE['auth_id']) and empty($_SESSION['auth']['id'])) {
			$_SESSION['auth']['id'] = $_COOKIE['auth_id'];
			$this->set_name_by_id();
		}
		if (empty($_SESSION['auth']['id'])) {
			header('Location: /');
		}
	}

	protected function set_disconnect () {		
		unset($_SESSION['auth']);
		setcookie('auth_id', '', time() - 100);
		header('Location: /index.php');
	}	

	public function get_login_check () {
		if (isset($_GET['auth_disconnect'])) {
			$this->set_disconnect();
			exit();
		} elseif (isset($_POST['login_login']) and empty($_POST['login_remember'])) {
			$this->set_id();
		} elseif (isset($_POST['login_remember'])) {
			$this->set_id(true);
		}
		if ($_SERVER['PHP_SELF'] == '/index.php') {
			$this->get_main_check();
		} else {
			$this->get_other_check();
		}
	}
}
