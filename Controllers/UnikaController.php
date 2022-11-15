<?php
namespace Controllers;
use Views;
use Models;

class UnikaController {
	protected function view_unika () {
		$view = new Views\View();
		$view->view_unika();
	}

	protected function set_summ () {
		$summ = 0;
		if (isset($_SESSION['unika']['list'])) {
			foreach ($_SESSION['unika']['list'] as $k => $v) {
				$summ = $summ + $v['price'];
			}
		}
		$_SESSION['unika']['summ'] = $summ;
	}

	protected function dell_product () {
		$key = $_GET['unika_dell'];
		unset($_SESSION['unika']['list'][$key]);
		header('Location: /unika.php');
	}

	protected function add_product () {
		$model = new Models\ProductModel();
		$code = $_GET['unika_add'];
		$search_p = 'code';
		if ($code[0] == '*') {
			$search_p = 'article';
			$code = trim($code, '*');
		}
		if ( ($product = $model->get_product($search_p, $code)) ) {
			array_push($_SESSION['unika']['list'], $product);
		}
		header('Location: /unika.php');
	}

	public function get_unika () {
		if (empty($_SESSION['unika']['list'])) {
			$_SESSION['unika'] = array();
			$_SESSION['unika']['list'] = array();
		}
		if (isset($_GET['unika_add'])) {
			$this->add_product();
		} elseif (isset($_GET['unika_dell'])) {
			$this->dell_product();
		}
		$this->set_summ();
		$this->view_unika();
	}
}