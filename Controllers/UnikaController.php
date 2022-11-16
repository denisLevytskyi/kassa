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
				$summ = $summ + $v['summ'];
			}
		}
		$_SESSION['unika']['summ'] = $summ;
	}

	protected function change_amount () {
		$val = abs(round($_GET['unika_amount_val'], 3));
		$key = $_GET['unika_amount_key'];
		$price = $_SESSION['unika']['list'][$key]['price'];
		$_SESSION['unika']['list'][$key]['amount'] = $val;
		$_SESSION['unika']['list'][$key]['summ'] = round($val * $price, 2);
		header('Location: /unika.php');
	}

	protected function dell_product () {
		$key = $_GET['unika_dell'];
		unset($_SESSION['unika']['list'][$key]);
		header('Location: /unika.php');
	}

	protected function set_check () {
		$rezult = false;
		$auth_id = $_SESSION['auth']['id'];
		$auth_name = $_SESSION['auth']['name'];
		$time = time();
		$summ = $_SESSION['unika']['summ'];
		$body = serialize($_SESSION['unika']['list']);
		$received_cash = $_GET['unika_cash'];
		$received_card = 0;
		if ($_GET['unika_pay'] == 'card') {
			$received_card = round($summ - $received_cash, 2);
		} else {
			$received_card = 0;
		}
		if ($received_card < 0) {
			$received_card = 0;
		}
		$change = $summ - $received_cash - $received_card;
		$change = -round($change, 2);
		if ($change >= 0) {
			$model = new Models\CheckModel();
			$rezult = $model->get_check_registration($auth_id, $auth_name, $time, $summ, $body, $received_cash, $received_card, $change);
		}
		if ($rezult == true) {
			unset($_SESSION['unika']);
			header('Location: /unika.php');
		}
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
			$product['amount'] = 1;
			$product['summ'] = $product['price'];
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
		} elseif (isset($_GET['unika_amount_key']) and is_numeric($_GET['unika_amount_val'])) {
			$this->change_amount();
		} elseif (isset($_GET['unika_cash']) and is_numeric($_GET['unika_cash'])) {
			$this->set_check();
		}
		$this->set_summ();
		$this->view_unika();
	}
}