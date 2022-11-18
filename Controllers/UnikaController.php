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
		$summ = '0.00';
		if (isset($_SESSION['unika']['list'])) {
			foreach ($_SESSION['unika']['list'] as $k => $v) {
				$summ = $summ + $v['summ'];
			}
		}
		$_SESSION['unika']['summ'] = $summ;
	}

	protected function change_amount () {
		$val = abs(round($_POST['unika_amount_val'], 3));
		$key = $_POST['unika_amount_key'];
		$price = $_SESSION['unika']['list'][$key]['price'];
		$_SESSION['unika']['list'][$key]['amount'] = $val;
		$_SESSION['unika']['list'][$key]['summ'] = round($val * $price, 2);
		header('Location: /unika.php');
	}

	protected function del_product () {
		$key = $_GET['unika_del'];
		unset($_SESSION['unika']['list'][$key]);
		header('Location: /unika.php');
	}
	
	protected function set_z_id () {
		$model = new Models\StaffModel();
		if ( ($rezult = $model->get_last_z_data()) ) {
			return $rezult['id'] + 1;
		} else {
			return 1;
		}
	}

	protected function set_check () {
		$z_id = $this->set_z_id();
		$rezult = false;
		$time = time();
		$auth_id = $_SESSION['auth']['id'];
		$auth_name = $_SESSION['auth']['name'];
		$body = serialize($_SESSION['unika']['list']);
		$summ = $_SESSION['unika']['summ'];
		$received_cash = round($_POST['unika_cash'], 2);
		$received_card = 0;
		if ($_POST['unika_pay'] == 'card') {
			$received_card = $summ - $received_cash;
		} else {
			$received_card = 0;
		}
		if ($received_card < 0) {
			$received_card = 0;
		}
		$change = $summ - $received_cash - $received_card;
		$change = -round($change, 2);
		if ($change >= 0 and $summ > 0) {
			$model = new Models\CheckModel();
			$rezult = $model->get_check_registration($z_id, $auth_id, $auth_name, $time, $summ, $body, $received_cash, $received_card, $change);
		}
		if ($rezult == true) {
			unset($_SESSION['unika']);
			$check = $model->get_check('timestamp', $time);
			$check_id = $check['id'];
			header("Location: /check.php/?check_id=$check_id");
		}
	}

	protected function add_product () {
		$model = new Models\ProductModel();
		$code = $_POST['unika_add'];
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
		if (empty($_SESSION['unika'])) {
			$_SESSION['unika'] = array();
		}
		if (empty($_SESSION['unika']['list'])) {
			$_SESSION['unika']['list'] = array();
		}
		if (isset($_POST['unika_add'])) {
			$this->add_product();
		} elseif (isset($_GET['unika_del'])) {
			$this->del_product();
		} elseif (isset($_POST['unika_amount_key']) and is_numeric($_POST['unika_amount_val'])) {
			$this->change_amount();
		} elseif (isset($_POST['unika_cash']) and is_numeric($_POST['unika_cash'])) {
			$this->set_check();
		}
		$this->set_summ();
		$this->view_unika();
	}
}