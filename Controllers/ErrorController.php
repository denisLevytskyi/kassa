<?php
namespace Controllers;
use Views;
use Models;

class ErrorController {
	protected function view_error () {
		$view = new Views\View();
		$view->view_error();
	}

	public function get_error_check () {
		if (isset($_SESSION['error'])) {
			$this->view_error();
		} else {
			header('Location: /index.php');
		}
	}

	public static function view_error1() {
		session_start();
		$_SESSION['error'] = 1;
		$_SESSION['error_desc'] = 'Login or password is incorrect!';
		header('Location: /error.php');
	}

	public static function view_error2() {
		session_start();
		$_SESSION['error'] = 2;
		$_SESSION['error_desc'] = "Passwords didn't match!";
		header('Location: /error.php');
	}

	public static function view_error3() {
		session_start();
		$_SESSION['error'] = 3;
		$_SESSION['error_desc'] = "PIN from email does not match!";
		header('Location: /error.php');
	}

	public static function view_error4() {
		session_start();
		$_SESSION['error'] = 4;
		$_SESSION['error_desc'] = "PIN of Administrator does not match!";
		header('Location: /error.php');
	}

	public static function view_error5() {
		session_start();
		$_SESSION['error'] = 5;
		$_SESSION['error_desc'] = "Problems with data entry!";
		header('Location: /error.php');
	}

	public static function view_error6() {
		session_start();
		$_SESSION['error'] = 6;
		$_SESSION['error_desc'] = 'No name for this id!';
		header('Location: /error.php');
	}

	public static function view_error7() {
		session_start();
		$_SESSION['error'] = 7;
		$_SESSION['error_desc'] = 'No login for this id!';
		header('Location: /error.php');
	}

	public static function view_error8() {
		session_start();
		$_SESSION['error'] = 8;
		$_SESSION['error_desc'] = "New passwords didn't match!";
		header('Location: /error.php');
	}

	public static function view_error9() {
		session_start();
		$_SESSION['error'] = 9;
		$_SESSION['error_desc'] = "Problems with data entry! (CHANGES)";
		header('Location: /error.php');
	}

	public static function view_error10() {
		session_start();
		$_SESSION['error'] = 10;
		$_SESSION['error_desc'] = "Problems with data entry! (DELETE)";
		header('Location: /error.php');
	}

	public static function view_error11() {
		session_start();
		$_SESSION['error'] = 11;
		$_SESSION['error_desc'] = "Problems with data entry! (Add product)";
		header('Location: /error.php');
	}
}