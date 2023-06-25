<?php
namespace Controllers;
use Views;
use Models;

class TerminalController {
	protected function set_refresh_data ($type, $data) {
		foreach ($data as $k => $v) {
			if ($type == 'users') {
				$model = new Models\AuthModel();
				$model->get_user_sign($v['login'], $v['password'], $v['name'], $v['role']);
			} elseif ($type == 'products') {
				$model = new Models\ProductModel();
				$model->get_product_registration($v['group'], $v['article'], $v['code'], $v['name'], $v['description'], $v['photo'], $v['auth_id']);
			} elseif ($type == 'prices') {
				$model = new Models\PriceModel();
				$model->get_price_registration($v['article'], $v['price'] * 100, $v['timestamp'], $v['auth_id']);
			}
		}
		echo '+';
	}

	protected function get_refresh ($data) {
		foreach ($data as $k => $v) {
			$model = new Models\MoonModel();
			if ( ($model->get_truncate($k)) ) {
				$this->set_refresh_data($k, $v);
			}
		}
	}

	protected function get_update ($type, $id) {
		$model = new Models\MoonModel();
		if ( ($model->get_factor_update($type, $id)) ) {
			echo 1;
		}
	}

	protected function get_data () {
		$model1 = new Models\CheckModel();
		$model2 = new Models\StaffModel();
		$model3 = new Models\StaffModel();
		$checks = $model->get_checks('base_factor', 0);
		$branches = $model->get_branches('base_factor', 0);
		$balances = $model->get_balances('base_factor', 0, 0);
		$data = array (
			'checks' => $checks,
			'branches' => $branches,
			'balances' => $balances
		);
		echo serialize($data);
	}

	public function get_terminal () {
		if (empty($_POST['terminal_key']) and $_POST['terminal_key'] != 1) {
			exit();
		}
		if (isset($_POST['terminal_code']) and $_POST['terminal_code'] == 1) {
			$this->get_data();
		} elseif (isset($_POST['terminal_code']) and isset($_POST['terminal_data']) and $_POST['terminal_code'] == 2) {
			$this->get_update($_POST['terminal_data']['type'], $_POST['terminal_data']['id']);
		} elseif (isset($_POST['terminal_code']) and isset($_POST['terminal_data']) and $_POST['terminal_code'] == 3) {
			$this->get_refresh($_POST['terminal_data']);
		}
	}
}
