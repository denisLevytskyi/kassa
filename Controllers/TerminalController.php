<?php
namespace Controllers;
use Views;
use Models;

class TerminalController {
	protected function get_delete_factor () {
		$result = array();
		$model = new Models\MoonModel();
		$result['fiskal_checks'] = $model->get_factor_delete('fiskal_checks');
		$result['fiskal_branches'] = $model->get_factor_delete('fiskal_branches');
		$result['fiskal_balances'] = $model->get_factor_delete('fiskal_balances');
		foreach ($result as $k => $v) {
			if ($v) {
				echo "\\n	$k => OK ";
			} else {
				echo "\\n	$k => FAIL ";
			}
		}
	}

	protected function set_new_data ($type, $data) {
		$result = FALSE;
		foreach ($data as $k => $v) {
			if ($type == 'app_users') {
				$model = new Models\AuthModel();
				$result = $model->get_user_sign($v['login'], $v['password'], $v['name'], $v['role']);
			} elseif ($type == 'app_products') {
				$model = new Models\ProductModel();
				$result = $model->get_product_registration($v);
			} elseif ($type == 'app_prices') {
				$model = new Models\PriceModel();
				$result = $model->get_price_registration($v['article'], $v['price'] * 100, $v['timestamp'], $v['auth_id']);
			}
			if ($result) {
				echo "\\n	$type => #$k OK";
			} else {
				echo "\\n	$type => #$k FAIL";
			}
		}
	}

	protected function get_truncate_tables ($data) {
		$data = unserialize($data);
		foreach ($data as $k => $v) {
			$model = new Models\MoonModel();
			if ( ($model->get_truncate($k)) ) {
				$this->set_new_data($k, $v);
			} else {
				echo "\\n	$k => No truncate!";
			}
		}
	}

	protected function get_update_factor ($type, $id) {
		$model = new Models\MoonModel();
		if ( ($model->get_factor_update($type, $id)) ) {
			echo "	$type => #$id OK";
		} else {
			echo "	$type => #$id FAIL";
		}
	}

	protected function give_docs () {
		$model1 = new Models\CheckModel();
		$model2 = new Models\StaffModel();
		$checks = $model1->get_checks('base_factor', 0);
		$branches = $model2->get_branches('base_factor', 0);
		$balances = $model2->get_balances('base_factor', 0, 0);
		$data = array (
			'fiskal_checks' => $checks,
			'fiskal_branches' => $branches,
			'fiskal_balances' => $balances
		);
		echo serialize($data);
	}

	public function get_terminal () {
		if ( (!isset($_POST['terminal_key']) or $_POST['terminal_key'] != 1) and !isset($_GET['terminal_seed'])) {
			exit();
		}
		if (isset($_POST['terminal_code']) and $_POST['terminal_code'] == 1) {
			$this->give_docs();
		} elseif (isset($_POST['terminal_code']) and isset($_POST['terminal_data']) and $_POST['terminal_code'] == 2) {
			$this->get_update_factor($_POST['terminal_data']['type'], $_POST['terminal_data']['id']);
		} elseif (isset($_POST['terminal_code']) and isset($_POST['terminal_data']) and $_POST['terminal_code'] == 3) {
			$this->get_truncate_tables($_POST['terminal_data']);
		} elseif (isset($_POST['terminal_code']) and $_POST['terminal_code'] == 4) {
			$this->get_delete_factor();
		} elseif (isset($_GET['terminal_seed'])) {
			$data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/_seed.txt');
			$this->get_truncate_tables($data);
		}
	}
}