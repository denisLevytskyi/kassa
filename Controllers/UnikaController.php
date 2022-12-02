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
		if (!empty($_SESSION['unika']['list'])) {
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

	protected function set_tax_data () {
		$data = array(
			'summ_a' => '0',
			'summ_b' => '0',
			'summ_v' => '0',
			'summ_g' => '0',
			'summ_m+a' => '0',
			'summ_tax_a' => '0',
			'summ_tax_b' => '0',
			'summ_tax_v' => '0',
			'summ_tax_g' => '0',
			'summ_tax_m+a' => '0'
		);
		$list = $_SESSION['unika']['list'];
		foreach ($list as $k => $v) {
			if ($v['group'] == 'А') {
				$data['summ_a'] += $v['summ'];
				$data['summ_tax_a'] += $v['summ'] * 20 / 120;
			} elseif ($v['group'] == 'Б') {
				$data['summ_b'] += $v['summ'];
				$data['summ_tax_b'] += $v['summ'] * 14 / 114;
			} elseif ($v['group'] == 'В') {
				$data['summ_v'] += $v['summ'];
				$data['summ_tax_v'] += $v['summ'] * 7 / 107;
			} elseif ($v['group'] == 'Г') {
				$data['summ_g'] += $v['summ'];
				$data['summ_tax_g'] += $v['summ'] * 0 / 100;
			} elseif ($v['group'] == 'М+А') {
				$summ_m = $v['summ'];
				$summ_tax_m = $v['summ'] * 6 / 106;
				$data['summ_m+a'] += $summ_m;
				$data['summ_tax_m+a'] += $summ_tax_m;
				$data['summ_a'] += $summ_m - $summ_tax_m;
				$data['summ_tax_a'] += ($summ_m - $summ_tax_m) * 20 / 120;
			}
		}
		return $data;
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
		$tax_data = $this->set_tax_data();
		$rezult = false;
		$data = array(
			'z_id' => $this->set_z_id(),
			'auth_id' => $_SESSION['auth']['id'],
			'auth_name' =>  $_SESSION['auth']['name'],
			'timestamp' => time(),
			'type' => $this->set_check_type(),
			'body' => serialize($_SESSION['unika']['list']),
			'received_cash' => $_POST['unika_cash'],
			'received_card' => '0',
			'change' => '0',
			'summ' => $_SESSION['unika']['summ'],
			'summ_a' => $tax_data['summ_a'],
			'summ_b' => $tax_data['summ_b'],
			'summ_v' => $tax_data['summ_v'],
			'summ_g' => $tax_data['summ_g'],
			'summ_m+a' => $tax_data['summ_m+a'],
			'summ_tax_a' => $tax_data['summ_tax_a'],
			'summ_tax_b' => $tax_data['summ_tax_b'],
			'summ_tax_v' => $tax_data['summ_tax_v'],
			'summ_tax_g' => $tax_data['summ_tax_g'],
			'summ_tax_m+a' => $tax_data['summ_tax_m+a']
		);
		if ($_POST['unika_pay'] == 'card') {
			$data['received_card'] = $data['summ'] - $data['received_cash'];
		} else {
			$data['received_card'] = 0;
		}
		if ($data['received_card'] < 0) {
			$data['received_card'] = 0;
		}
		$data['change'] = $data['summ'] - $data['received_cash'] - $data['received_card'];
		$change = -$data['change'];
		foreach ($data as $k => $v) {
			if (is_numeric($v)) {
				$data[$k] = abs(round($v, 2));
			}
		}
		if ($change >= 0 and $data['summ'] >= 0 and isset($data['type'])) {
			$model = new Models\CheckModel();
			$rezult = $model->get_check_registration($data);
		}
		if ($rezult == true) {
			unset($_SESSION['unika']);
			$check = $model->get_check('timestamp', $data['timestamp']);
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
				$_SESSION['unika']['list'][$k]['article'] .= 's';
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

	protected function set_mark ($code) {
		$mark = trim($code, '!');
		$key = array_key_last($_SESSION['unika']['list']);
		if ($key !== null) {
			$_SESSION['unika']['list'][$key]['name'] .= '<br>А/М: ' . $mark;
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
		} elseif ($code[0] == '!') {
			$this->set_mark($code);
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