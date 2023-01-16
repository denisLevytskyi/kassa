<?php
namespace Controllers;
use Views;
use Models;

class UnikaController extends StaffController {
	protected function view_unika () {
		$view = new Views\View();
		$view->view_unika();
	}

	protected function set_sum () {
		$sum = '0.00';
		if (!empty($_SESSION['unika']['list'])) {
			foreach ($_SESSION['unika']['list'] as $k => $v) {
				$sum = $sum + $v['sum'];
			}
		}
		$_SESSION['unika']['sum'] = $sum;
	}

	protected function change_amount () {
		$val = abs(round($_POST['unika_amount_val'], 3));
		$key = $_POST['unika_amount_key'];
		$price = $_SESSION['unika']['list'][$key]['price'];
		$_SESSION['unika']['list'][$key]['amount'] = $val;
		$_SESSION['unika']['list'][$key]['sum'] = round($val * $price, 2);
		header('Location: /unika.php');
	}

	protected function del_product () {
		$key = $_GET['unika_del'];
		unset($_SESSION['unika']['list'][$key]);
		header('Location: /unika.php');
	}

	protected function set_tax_data () {
		$data = array(
			'sum_a' => '0',
			'sum_b' => '0',
			'sum_v' => '0',
			'sum_g' => '0',
			'sum_m' => '0',
			'sum_tax_a' => '0',
			'sum_tax_b' => '0',
			'sum_tax_v' => '0',
			'sum_tax_g' => '0',
			'sum_tax_m' => '0'
		);
		$list = $_SESSION['unika']['list'];
		foreach ($list as $k => $v) {
			if ($v['group'] == 'А') {
				$data['sum_a'] += $v['sum'];
				$data['sum_tax_a'] += $v['sum'] * 20 / 120;
			} elseif ($v['group'] == 'Б') {
				$data['sum_b'] += $v['sum'];
				$data['sum_tax_b'] += $v['sum'] * 14 / 114;
			} elseif ($v['group'] == 'В') {
				$data['sum_v'] += $v['sum'];
				$data['sum_tax_v'] += $v['sum'] * 7 / 107;
			} elseif ($v['group'] == 'Г') {
				$data['sum_g'] += $v['sum'];
				$data['sum_tax_g'] += $v['sum'] * 0 / 100;
			} elseif ($v['group'] == 'М+А') {
				$sum_m = $v['sum'];
				$sum_tax_m = $v['sum'] * 5 / 105;
				$data['sum_m'] += $sum_m;
				$data['sum_tax_m'] += $sum_tax_m;
				$data['sum_a'] += $sum_m - $sum_tax_m;
				$data['sum_tax_a'] += ($sum_m - $sum_tax_m) * 20 / 120;
			}
		}
		return $data;
	}
	
	protected function set_check_type () {
		$cash = $_POST['unika_cash'];
		$sum = $_SESSION['unika']['sum'];
		$count = count($_SESSION['unika']['list']);
		$data = $this->set_balance_data();
		$result = $data['balance_close'] - $cash;
		if ($count == 0 or $sum < 0) {
			return null;
		} elseif ($sum == 0 or isset($_POST['unika_null'])) {
			return 'АНУЛЬОВАНО';
		} elseif ($result >= 0 and isset($_POST['unika_return'])) {
			$admin = new AdminController();
			$admin->get_admin_check(4);
			return 'ВИДАТКОВИЙ ЧЕК';
		} elseif ($cash <= 50000 and empty($_POST['unika_return'])) {
			return 'ФІСКАЛЬНИЙ ЧЕК';
		} else {
			return null;
		}
	}

	protected function set_check () {
		$tax_data = $this->set_tax_data();
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
			'sum' => $_SESSION['unika']['sum'],
			'sum_a' => $tax_data['sum_a'],
			'sum_b' => $tax_data['sum_b'],
			'sum_v' => $tax_data['sum_v'],
			'sum_g' => $tax_data['sum_g'],
			'sum_m' => $tax_data['sum_m'],
			'sum_tax_a' => $tax_data['sum_tax_a'],
			'sum_tax_b' => $tax_data['sum_tax_b'],
			'sum_tax_v' => $tax_data['sum_tax_v'],
			'sum_tax_g' => $tax_data['sum_tax_g'],
			'sum_tax_m' => $tax_data['sum_tax_m']
		);
		if ($_POST['unika_pay'] == 'card') {
			$data['received_card'] = $data['sum'] - $data['received_cash'];
		} else {
			$data['received_card'] = 0;
		}
		if ($data['received_card'] < 0) {
			$data['received_card'] = 0;
		}
		$data['change'] = $data['sum'] - $data['received_cash'] - $data['received_card'];
		$change = -$data['change'];
		foreach ($data as $k => $v) {
			if (is_numeric($v)) {
				$data[$k] = abs(round($v, 2));
			}
		}
		if ($change >= 0 and isset($data['type'])) {
			$model = new Models\CheckModel();
			if ( ($model->get_check_registration($data)) ) {
				unset($_SESSION['unika']);
				$check = $model->get_check('timestamp', $data['timestamp']);
				$check_id = $check['id'];
				header("Location: /check.php/?check_id=$check_id");
			}
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
				$_SESSION['unika']['list'][$k]['sum'] = round(
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
			$product['sum'] = round($product['price'] * $amount, 2);
			$_SESSION['unika']['list'][] = $product;
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
		$this->set_sum();
		$this->view_unika();
	}
}