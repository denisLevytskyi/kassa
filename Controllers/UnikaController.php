<?php
namespace Controllers;
use Views;
use Models;

class UnikaController extends StaffController {
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
	
	protected function set_check_type () {
		$cash = $_POST['unika_cash'];
		$summ = $_SESSION['unika']['summ'];
		$count = count($_SESSION['unika']['list']);
		$data = $this->set_balance_data();
		$rezult = $data['balance_close'] - $cash;
		if ($count == 0) {
			return;
		}
		if ($summ == 0) {
			return 'АНУЛЬВОНО';
		} elseif ($rezult >= 0 and isset($_POST['unika_return'])) {
			return 'ВИДАТКОВИЙ ЧЕК';
		} elseif ($cash < 100000 and empty($_POST['unika_return'])) {
			return 'ФІСКАЛЬНИЙ ЧЕК';
		} else {
			return;
		}
	}

	protected function set_check () {
		$rezult = false;
		$z_id = $this->set_z_id();
		$auth_id = $_SESSION['auth']['id'];
		$auth_name = $_SESSION['auth']['name'];
		$time = time();
		$type = $this->set_check_type();
		$body = serialize($_SESSION['unika']['list']);
		$received_cash = round($_POST['unika_cash'], 2);
		$received_card = 0;
		$summ = $_SESSION['unika']['summ'];
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
		if ($change >= 0 and $summ >= 0 and isset($type)) {
			$model = new Models\CheckModel();
			$rezult = $model->get_check_registration($z_id, $auth_id, $auth_name, $time, $type, $body, $received_cash, $received_card, $change, $summ);
		}
		if ($rezult == true) {
			unset($_SESSION['unika']);
			$check = $model->get_check('timestamp', $time);
			$check_id = $check['id'];
			header("Location: /check.php/?check_id=$check_id");
		}
	}

	protected function set_sale ($code) {
		$sale = mb_substr($code, 1, 2);
		$article = mb_substr($code, 3);
		if (empty($_SESSION['unika']['list']) or !is_numeric($sale) or $sale < 0) {
			return;
		}
		foreach ($_SESSION['unika']['list'] as $k => $v) {
			if ($v['article'] == $article) {
				$_SESSION['unika']['list'][$k]['article'] .= '_S';
				$_SESSION['unika']['list'][$k]['name'] .= ' (-' . $sale . '%)';
				$_SESSION['unika']['list'][$k]['price'] = round(
					$_SESSION['unika']['list'][$k]['price'] * (100 - $sale) / 100, 2
				);
				$_SESSION['unika']['list'][$k]['summ'] = round(
					$_SESSION['unika']['list'][$k]['price'] * $_SESSION['unika']['list'][$k]['amount'], 2
				);
				return;
			}
		}
	}

	protected function add_product () {
		$model = new Models\ProductModel();
		$code = $_POST['unika_add'];
		$search_p = 'code';
		$amount = 1;
		if ($code[0] == '*') {
			$search_p = 'article';
			$code = trim($code, '*');
		} elseif ($code[0] == '=') {
			$search_p = 'name';
			$code = trim($code, '=');
		} elseif ($code[0] == '~') {
			$this->set_sale($code);
		} elseif ($code[0] == 'i') {
			$search_p = 'id';
			$code = trim($code, 'i');
		} elseif (mb_substr($code, 0, 3) == '250' and is_numeric($code)) {
			$search_p = 'article';
			$code = mb_substr($code, 3, 5);
			$amount = mb_substr($_POST['unika_add'], 8) / 1000;
			$amount = abs(round($amount, 3));
		}
		if ( ($product = $model->get_product($search_p, $code)) ) {
			$product['amount'] = $amount;
			$product['summ'] = round($product['price'] * $amount, 2);
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