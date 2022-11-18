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
		if (isset($_SESSION['error']['n'])) {
			$this->view_error();
		} else {
			header('Location: /index.php');
		}
	}

	public static function get_view_error ($n = 0) {
		$error_desc = array(
			0 => 'Unknown error!',
			1 => 'Login or password is incorrect!',
			2 => "Passwords didn't match!",
			3 => "PIN from email does not match!",
			4 => "PIN of Administrator does not match!",
			5 => "Problems with data entry!",
			6 => 'No name for this id!',
			7 => 'No login for this id!',
			8 => "New passwords didn't match!",
			9 => "Problems with data entry! (CHANGES)",
			10 => "Problems with data entry! (DELETE)",
			11 => "Problems with data entry! (ADD PRODUCT)",
			12 => "Data retrieval problem (SHOW PRODUCT LIST)",
			13 => "Problems with data entry! (RESET)",
			14 => "Product not selected!",
			15 => "Problems with data entry! (PRODUCT)",
			16 => "Problems with data entry! (CHANG PRODUCT)",
			17 => "Problems with data entry! (DELETE PRODUCT)",
			18 => "Product not found!",
			19 => "Problems with data entry! (PRICE SETTER)",
			20 => "Data retrieval problem (SHOW PRICE LIST)",
			21 => "Data retrieval problem (SHOW CHECK LIST)",
			22 => "Check not selected!",
			23 => "Check not found!",
			24 => "Problems with data entry! (BRANCH SETTER)",
		);
		session_start();
		$_SESSION['error']['n'] = $n;
		$_SESSION['error']['desc'] = $error_desc[$n];
		header('Location: /error.php');
	}
}