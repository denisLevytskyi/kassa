<?php
namespace Controllers;
use Views;
use Models;

class SignController {
	protected function view_sign1 () {
		$view = new Views\View();
		$view->view_template('sign1');
	}

	protected function view_sign2 () {
		$view = new Views\View();
		$view->view_template('sign2');
	}

	protected function get_email_check () {
		$login = $_POST['sign_login'];
		$model = new Models\AuthModel();
		if ( ($model->get_user('login', $login, 'login', $login)) ) {
			ErrorController::get_view_error(35);
		} else {
			$this->send_pin();
		}
	}

	protected function send_pin () {
		// $pin = rand(1000, 9999);
		$pin = 1;
		$text = 'Dear ' . $_POST['sign_name'] .', this is your PIN for registration: ' . $pin;
		$mail1_to = $_POST['sign_login'];
		$headers="From: LVZ <lvz@lvz.ua>\nReply-to:lvz@lvz.ua\nContent-Type: text/html; charset=\"utf-8\"\n";
		mail($mail1_to, 'Registration on the portal LVZ', $text, $headers);
		session_start();
		$_SESSION['sign_pin_1'] = $pin;
	}

	protected function set_sign () {
		$login = $_POST['sign_login'];
		$password = $_POST['sign_password_1'];
		$name = $_POST['sign_name'];
		$model = new Models\AuthModel();
		if ( ($data = $model->get_user_sign($login, $password, $name)) ) {
			session_start();
			$_SESSION['auth']['id'] = $data['id'];
			header('Location: /');
		} else {
			ErrorController::get_view_error(5);
		}
	}

	protected function get_check_pin1 () {
		if ($_POST['sign_pin_1'] == $_SESSION['sign_pin_1']) {
			$this->get_check_pin2();
			unset($_SESSION['sign_pin_1']);
		} else {
			ErrorController::get_view_error(3);
		}
	}

	protected function get_check_pin2 () {
		if ($_POST['sign_pin_2'] == '1') {
			$this->set_sign();
		} else {
			ErrorController::get_view_error(4);
		}
	}

	public function get_sign_check () {
		if (isset($_POST['sign_2'])) {
			$this->get_check_pin1();
			exit;
		} elseif (empty($_POST['sign_1'])) {
			$this->view_sign1();
		} elseif ($_POST['sign_password_1'] == $_POST['sign_password_2']) {
			$this->get_email_check();
			$this->view_sign2();
		} else {
			ErrorController::get_view_error(2);
		}
	}
}