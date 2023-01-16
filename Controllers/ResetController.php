<?php
namespace Controllers;
use Views;
use Models;

class ResetController {
	protected function view_reset () {
		$view = new Views\View();
		$view->view_reset();
	}

	protected function set_reset ($password) {
		$login = $_POST['reset_login'];
		$model = new Models\AuthModel();
		if ( ($model->get_reset($login, $password)) ) {
			header('Location: /');
		} else {
			ErrorController::get_view_error(13);
		}
	}

	protected function get_new_password () {
		$password = rand(1000000, 9999999);
		$this->set_reset($password);
		$text = 'Dear User, this is your new password: ' . $password;
		$mail1_to = $_POST['reset_login'];
		$headers="From: LVZ <lvz@lvz.ua>\nReply-to:lvz@lvz.ua\nContent-Type: text/html; charset=\"utf-8\"\n";
		mail($mail1_to, 'Reset password on the portal LVZ', $text, $headers);
	}

	protected function get_email_check () {
		$login = $_POST['reset_login'];
		$model = new Models\AuthModel();
		if ( ($model->get_user_data('login', $login, 'login', $login)) ) {
			$this->get_new_password();
		} else {
			ErrorController::get_view_error(36);
		}
	}

	public function get_reset_check () {
		if (isset($_POST['reset_login'])) {
			$this->get_email_check();
		} else {
			$this->view_reset();
		}
	}
}