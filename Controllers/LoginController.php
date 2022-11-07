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

	protected function view_error1() {
		session_start();
		$_SESSION['error'] = 1;
		$_SESSION['error_desc'] = 'Login or password is incorrect!';
		header('Location: /error.php');
	}

	protected function view_error6() {
		session_start();
		$_SESSION['error'] = 6;
		$_SESSION['error_desc'] = 'No name for this id!';
		header('Location: /error.php');
	}

	protected function set_id ($remember = false) {
		$model = new Models\AuthModel();
		$login = $_POST['login_login'];
		$password = $_POST['login_password'];
		if ( ($id = $model->get_user_check($login, $password)) ) {
			if ($remember == true) {
				setcookie('auth_id', $id, time() + 10000);
			}
			$_SESSION['auth_id'] = $id;
		} else {
			$this->view_error1();
		}
	}

	protected function set_name_by_id () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth_id'];
		if ( ($name = $model->get_name_by_id($id)) ) {
			$_SESSION['auth_name'] = $name;
		} else {
			$this->set_disconnect();
			$this->view_error6();
		}
	}

	protected function get_main_check () {
		if (isset($_SESSION['auth_id'])) {
			$this->set_name_by_id();
			$this->view_main();
		} elseif (isset($_COOKIE['auth_id'])) {
			$_SESSION['auth_id'] = $_COOKIE['auth_id'];
			$this->set_name_by_id();
			$this->view_main();
		} else {
			$this->view_login();
		}
	}

	protected function get_other_check () {
		if (isset($_COOKIE['auth_id'])) {
			$_SESSION['auth_id'] = $_COOKIE['auth_id'];
			$this->set_name_by_id();
		}
		if (empty($_SESSION['auth_id'])) {
			header('Location: /');
		}
	}

	protected function set_disconnect () {		
		unset($_SESSION['auth_id']);
		unset($_SESSION['auth_name']);
		setcookie('auth_id', '', time() - 100);
		header('Location: /index.php');
	}	

	public function get_login_check () {
		if (isset($_GET['disconnect'])) {
			$this->set_disconnect();
			exit();
		} elseif (isset($_POST['login_login'])) {
			if (isset($_POST['login_remember'])) {
				$this->set_id(true);
			} else {
				$this->set_id();
			}
		}
		if ($_SERVER['PHP_SELF'] == '/index.php') {
			$this->get_main_check();
		} else {
			$this->get_other_check();
		}
	}
}  