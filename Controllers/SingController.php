<?php
namespace Controllers;
use Views;
use Models;

class SingController {
	protected function view_sing1 () {
		$view = new Views\View();
		$view->view_sing1();
	}

	protected function view_sing2 () {
		$view = new Views\View();
		$view->view_sing2();
	}

	protected function send_pin () {
		// $pin = rand(1000, 9999);
		$pin = 1;
		$text = 'Dear ' . $_POST['sing_name'] .', this is your PIN for registration ' . $pin;
		$mail1_to = $_POST['sing_login'];
	    $headers="From: BVS <mail@akkzavodbvs.ru>\nReply-to:mail@akkzavodbvs.ru\nContent-Type: text/html; charset=\"utf-8\"\n";
	    mail($mail1_to, 'Registration on the portal LVZ', $text, $headers);
	    session_start();
	    $_SESSION['sing_pin_1'] = $pin;
	}

	protected function set_sing () {
		$login = $_POST['sing_login'];
		$password = $_POST['sing_password_1'];
		$name = $_POST['sing_name'];
		$model = new Models\AuthModel();
		if ( ($id = $model->get_user_sing($login, $password, $name)) ) {
			session_start();
			$_SESSION['auth_id'] = $id;
			header('Location: /');
		} else {
			ErrorController::get_view_error(5);
		}
	}

	protected function get_check_pin1 () {
		if ($_POST['sing_pin_1'] == $_SESSION['sing_pin_1']) {
			$this->get_check_pin2();
			unset($_SESSION['sing_pin_1']);
		} else {
			ErrorController::get_view_error(3);
		}
	}

	protected function get_check_pin2 () {
		if ($_POST['sing_pin_2'] == '1') {
			$this->set_sing();
		} else {
			ErrorController::get_view_error(4);
		}
	}

	public function get_sing_check () {
		if (isset($_POST['sing_2'])) {
			$this->get_check_pin1();
			exit;
		} elseif (empty($_POST['sing_1'])) {
			$this->view_sing1();
		} else {
			if ($_POST['sing_password_1'] == $_POST['sing_password_2']) {
				$this->send_pin();
				$this->view_sing2();
			} else {
				ErrorController::get_view_error(2);
			}
		}
	}
}