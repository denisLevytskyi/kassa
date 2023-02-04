<?php
namespace Controllers;
use Views;
use Models;

class LoginController {
	protected function view_login () {
		$view = new Views\View();
		$view->view_template('login');
	}

	protected function view_main () {
		$view = new Views\View();
		$view->view_template('main');
	}

	protected function set_id ($remember = false) {
		$model = new Models\AuthModel();
		$login = $_POST['login_login'];
		$password = $_POST['login_password'];
		if ( ($data = $model->get_user('login', $login, 'password', $password)) ) {
			if ($remember) {
				setcookie('auth_id', $data['id'], time() + 10000);
			}
			$_SESSION['auth']['id'] = $data['id'];
		} else {
			ErrorController::get_view_error(1);
		}
	}

	protected function set_data_by_id () {
		$model = new Models\AuthModel();
		$id = $_SESSION['auth']['id'];
		if ( ($data = $model->get_user('id', $id, 'id', $id)) ) {
			$_SESSION['auth']['name'] = $data['name'];
			$_SESSION['auth']['login'] = $data['login'];
			$_SESSION['auth']['role'] = $data['role'];
		} else {
			$this->set_disconnect();
			ErrorController::get_view_error(6);
		}
	}

	protected function get_main_check () {
		if (isset($_SESSION['auth']['id'])) {
			$this->set_data_by_id();
			$this->view_main();
		} elseif (isset($_COOKIE['auth_id'])) {
			$_SESSION['auth']['id'] = $_COOKIE['auth_id'];
			$this->set_data_by_id();
			$this->view_main();
		} else {
			$this->view_login();
		}
	}

	protected function get_other_check () {
		if (isset($_COOKIE['auth_id']) and empty($_SESSION['auth']['id'])) {
			$_SESSION['auth']['id'] = $_COOKIE['auth_id'];
			$this->set_data_by_id();
		}
		if (empty($_SESSION['auth']['id'])) {
			header('Location: /');
			die();
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