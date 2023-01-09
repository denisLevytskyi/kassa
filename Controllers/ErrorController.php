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
			1 => 'LOGIN: Login or password is incorrect!',
			2 => "SIGN: Passwords didn't match!",
			3 => "SIGN: PIN from email does not match!",
			4 => "SIGN: PIN of Administrator does not match!",
			5 => "SIGN: Problems with data entry!",
			6 => 'LOGIN: No name for this id!',
			7 => 'EDIT AUTH: No login for this id!',
			8 => "EDIT AUTH: New passwords didn't match!",
			9 => "EDIT AUTH: Problems with update data!",
			10 => "EDIT AUTH: Problems with deleting data!",
			11 => "ADD PRODUCT: Problems with data entry!",
			12 => "PRODUCT LIST: List is empty!",
			13 => "RESET: Problems with reseting password",
			14 => "PRODUCT: Product not selected!",
			15 => "ADD PRODUCT: Problems with data entry!",
			16 => "PRODUCT: Problems with changing product!",
			17 => "PRODUCT: Problems with deleting product!",
			18 => "PRODUCT: Product not found!",
			19 => "PRICE SETTER: problems with data entry!",
			20 => "PRICE LIST: List is empty!",
			21 => "CHECK LIST: List is empty!",
			22 => "CHECK: Check not selected!",
			23 => "CHECK: Check not found!",
			24 => "STAFF: Problems with data entry! (BRANCH SETTER)",
			25 => "BRANCH: Branch not selected!",
			26 => "BRANCH: Branch not found!",
			27 => "BALANCE: Balance not selected!",
			28 => "BALANCE: Balance not found!",
			29 => "STAFF: Problems with data entry! (BALANCE)",
			30 => "KSEF: List is empty!",
			31 => "STAFF: The entered data is incorrect! (PERIODICAL SETTER)",
			32 => "ADMIN: Problems with data!",
			33 => "ADMIN: Problems with update data!",
			34 => "ADMIN: Not enough rights!"
		);
		session_start();
		$_SESSION['error']['n'] = $n;
		$_SESSION['error']['desc'] = $error_desc[$n];
		header('Location: /error.php');
	}
}
