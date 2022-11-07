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
}