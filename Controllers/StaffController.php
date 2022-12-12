<?php
namespace Controllers;
use Views;
use Models;

class StaffController {
	protected function view_staff () {
		$view = new Views\View();
		$view->view_staff();
	}

	protected function view_balance () {
		ob_start();
		$data = 'Ksef/X-balance_№_' . $_SESSION['balance']['id'] . '__' . $_SESSION['balance']['timestamp'] . '.html';
		$view = new Views\View();
		$view->view_balance();
		$model = new Models\KsefModel();
		$model->get_document_registrarion($data);
	}
	
	protected function set_z_balance_close () {
		$model = new Models\StaffModel();
		if ( ($rezult = $model->get_last_z_data()) ) {
			return $rezult['balance_close'];
		} else {
			return 0;
		}
	}

	protected function set_z_id () {
		$model = new Models\StaffModel();
		if ( ($rezult = $model->get_last_z_data()) ) {
			return $rezult['id'] + 1;
		} else {
			return 1;
		}
	}

	protected function set_balance () {
		$data = $this->set_balance_data();
		if ($_GET['staff_balance'] == 'X') {
			session_start();
			$_SESSION['balance'] = $data;
			$_SESSION['balance']['id'] = $this->set_z_id();
			$_SESSION['balance']['type'] = $_GET['staff_balance'];
			$_SESSION['balance']['time'] = date("y-m-d H:i:s", $data['timestamp']);
			$_SESSION['balance']['null_time_first'] = date("y-m-d H:i:s", $data['null_timestamp_first']);
			$_SESSION['balance']['null_time_last'] = date("y-m-d H:i:s", $data['null_timestamp_last']);
			$_SESSION['balance']['sale_time_first'] = date("y-m-d H:i:s", $data['sale_timestamp_first']);
			$_SESSION['balance']['sale_time_last'] = date("y-m-d H:i:s", $data['sale_timestamp_last']);
			$_SESSION['balance']['return_time_first'] = date("y-m-d H:i:s", $data['return_timestamp_first']);
			$_SESSION['balance']['return_time_last'] = date("y-m-d H:i:s", $data['return_timestamp_last']);
			$this->view_balance();
			exit();
		} elseif ($_GET['staff_balance'] == 'Z') {
			$this->set_balance_registration($data);
		}
	}
	
	protected function set_balance_data () {
		$gate0 = 0;
		$gate1 = 0;
		$gate2 = 0;
		$z_id = $this->set_z_id();
		$b_data = $this->set_branches_by_z_id($z_id);
		$c_data = $this->set_checks_by_z_id($z_id);
		$data = array(
			'auth_id' => $_SESSION['auth']['id'],
			'auth_name' => $_SESSION['auth']['name'],
			'timestamp' => time(),
			'staff_in' => '0',
			'staff_out' => '0',
			'null_id_first' => '0',
			'null_id_last' => '0',
			'null_timestamp_first' => time(),
			'null_timestamp_last' => time(),
			'null_checks' => '0',
			'sale_id_first' => '0',
			'sale_id_last' => '0',
			'sale_timestamp_first' => time(),
			'sale_timestamp_last' => time(),
			'sale_checks' => '0',
			'sale_received_cash' => '0',
			'sale_received_card' => '0',
			'sale_change' => '0',
			'sale_summ_cash' => '0',
			'sale_summ_card' => '0',
			'sale_summ' => '0',
			'sale_summ_a' => '0',
			'sale_summ_b' => '0',
			'sale_summ_v' => '0',
			'sale_summ_g' => '0',
			'sale_summ_m' => '0',
			'sale_summ_tax_a' => '0',
			'sale_summ_tax_b' => '0',
			'sale_summ_tax_v' => '0',
			'sale_summ_tax_g' => '0',
			'sale_summ_tax_m' => '0',
			'sale_summ_tax' => '0',
			'return_id_first' => '0',
			'return_id_last' => '0',
			'return_timestamp_first' => time(),
			'return_timestamp_last' => time(),
			'return_checks' => '0',
			'return_received_cash' => '0',
			'return_received_card' => '0',
			'return_change' => '0',
			'return_summ_cash' => '0',
			'return_summ_card' => '0',
			'return_summ' => '0',
			'return_summ_a' => '0',
			'return_summ_b' => '0',
			'return_summ_v' => '0',
			'return_summ_g' => '0',
			'return_summ_m' => '0',
			'return_summ_tax_a' => '0',
			'return_summ_tax_b' => '0',
			'return_summ_tax_v' => '0',
			'return_summ_tax_g' => '0',
			'return_summ_tax_m' => '0',
			'return_summ_tax' => '0',
			'summ_cash' => '0',
			'summ_card' => '0',
			'summ' => '0',
			'balance_open' => $this->set_z_balance_close(),
			'balance_close' => '0'
		);
		foreach ($b_data as $k => $v) {
			if ($v['type'] == 'СЛУЖБОВЕ ВИЛУЧЕННЯ') {
				$data['staff_out'] += $v['summ'];
			} elseif ($v['type'] == 'СЛУЖБОВЕ ВНЕСЕННЯ') {
				$data['staff_in'] += $v['summ'];
			}
		}
		foreach ($c_data as $k => $v) {
			if ($v['type'] == 'АНУЛЬВОНО') {
				if ($gate0 == 0) {
					$data['null_id_first'] = $v['id'];
					$data['null_timestamp_first'] = $v['timestamp'];
					$gate0 = 1;
				}
				$data['null_id_last'] = $v['id'];
				$data['null_timestamp_last'] = $v['timestamp'];
				$data['null_checks'] += 1;
			} elseif ($v['type'] == 'ФІСКАЛЬНИЙ ЧЕК') {
				if ($gate1 == 0) {
					$data['sale_id_first'] = $v['id'];
					$data['sale_timestamp_first'] = $v['timestamp'];
					$gate1 = 1;
				}
				$data['sale_id_last'] = $v['id'];
				$data['sale_timestamp_last'] = $v['timestamp'];
				$data['sale_checks'] += 1;
				$data['sale_received_cash'] += $v['received_cash'];
				$data['sale_received_card'] += $v['received_card'];
				$data['sale_change'] += $v['change'];
				$data['sale_summ'] += $v['summ'];
				$data['sale_summ_a'] += $v['summ_a'];
				$data['sale_summ_b'] += $v['summ_b'];
				$data['sale_summ_v'] += $v['summ_v'];
				$data['sale_summ_g'] += $v['summ_g'];
				$data['sale_summ_m'] += $v['summ_m'];
				$data['sale_summ_tax_a'] += $v['summ_tax_a'];
				$data['sale_summ_tax_b'] += $v['summ_tax_b'];
				$data['sale_summ_tax_v'] += $v['summ_tax_v'];
				$data['sale_summ_tax_g'] += $v['summ_tax_g'];
				$data['sale_summ_tax_m'] += $v['summ_tax_m'];
			} elseif ($v['type'] == 'ВИДАТКОВИЙ ЧЕК') {
				if ($gate2 == 0) {
					$data['return_id_first'] = $v['id'];
					$data['return_timestamp_first'] = $v['timestamp'];
					$gate2 = 1;
				}
				$data['return_id_last'] = $v['id'];
				$data['return_timestamp_last'] = $v['timestamp'];
				$data['return_checks'] += 1;
				$data['return_received_cash'] += $v['received_cash'];
				$data['return_received_card'] += $v['received_card'];
				$data['return_change'] += $v['change'];
				$data['return_summ'] += $v['summ'];
				$data['return_summ_a'] += $v['summ_a'];
				$data['return_summ_b'] += $v['summ_b'];
				$data['return_summ_v'] += $v['summ_v'];
				$data['return_summ_g'] += $v['summ_g'];
				$data['return_summ_m'] += $v['summ_m'];
				$data['return_summ_tax_a'] += $v['summ_tax_a'];
				$data['return_summ_tax_b'] += $v['summ_tax_b'];
				$data['return_summ_tax_v'] += $v['summ_tax_v'];
				$data['return_summ_tax_g'] += $v['summ_tax_g'];
				$data['return_summ_tax_m'] += $v['summ_tax_m'];
			}
		}
		$data['sale_summ_cash'] = $data['sale_received_cash'] - $data['sale_change'];
		$data['sale_summ_card'] = $data['sale_received_card'];
		$data['sale_summ_tax'] = (
			$data['sale_summ_tax_a'] +
			$data['sale_summ_tax_b'] +
			$data['sale_summ_tax_v'] +
			$data['sale_summ_tax_g'] +
			$data['sale_summ_tax_m']
		);
		$data['return_summ_cash'] = $data['return_received_cash'] - $data['return_change'];
		$data['return_summ_card'] = $data['return_received_card'];
		$data['return_summ_tax'] = (
			$data['return_summ_tax_a'] +
			$data['return_summ_tax_b'] +
			$data['return_summ_tax_v'] +
			$data['return_summ_tax_g'] +
			$data['return_summ_tax_m']
		);
		$data['summ_cash'] = $data['sale_summ_cash'] - $data['return_summ_cash'];
		$data['summ_card'] = $data['sale_summ_card'] - $data['return_summ_card'];
		$data['summ'] = $data['sale_summ'] - $data['return_summ'];
		$data['balance_close'] = $data['balance_open'] + $data['summ_cash'] + $data['staff_in'] - $data['staff_out'];
		foreach ($data as $k => $v) {
			if (is_numeric($v)) {
				$data[$k] = round($v, 2);
			}
		}
		return $data;
	}

	protected function set_balance_registration ($data) {
		$model = new Models\StaffModel();
		if ( ($model->get_balance_registration($data)) ) {
			$balance = $model->get_balance('timestamp', $data['timestamp']);
			$balance_id = $balance['id'];
			header("Location: /balance.php/?balance_id=$balance_id");
		} else {
			ErrorController::get_view_error(29);
		}
	}
	
	protected function prepare_branch_registration () {
		$summ = $_POST['staff_branch_summ'];
		$data = $this->set_balance_data();
		$rezult = $data['balance_close'] + $summ;
		if ($rezult >= 0 and $rezult < 100000) {
			$this->set_branch_registration();
		}
	}

	protected function set_branch_registration () {
		$model = new Models\StaffModel();
		$z_id = $this->set_z_id();
		$auth_id = $_SESSION['auth']['id'];
		$auth_name = $_SESSION['auth']['name'];
		$time = time();
		$type = "НУЛЬОВИЙ ЧЕК";
		$summ = round($_POST['staff_branch_summ'], 2);
		if ($summ < 0) {
			$summ = -$summ;
			$type = 'СЛУЖБОВЕ ВИЛУЧЕННЯ';
		} elseif ($summ > 0) {
			$type = 'СЛУЖБОВЕ ВНЕСЕННЯ';
		}
		if ( ($model->get_branch_registration($z_id, $auth_id, $auth_name, $time, $type, $summ)) ) {
			$branch = $model->get_branch('timestamp', $time);
			$branch_id = $branch['id'];
			header("Location: /branch.php/?branch_id=$branch_id");
		} else {
			ErrorController::get_view_error(24);
		}
	}
	
	protected function set_checks_by_z_id ($z_id) {
		$model = new Models\CheckModel();
		if ( ($checks = $model->get_checks_by_z_id($z_id)) ) {
			return $checks;
		} else {
			$checks = array(array(
				'type' => null
			));
			return $checks;
		}
	}
	
	protected function set_branches_by_z_id ($z_id) {
		$model = new Models\StaffModel();
		if ( ($branches = $model->get_branches_by_z_id($z_id)) ) {
			return $branches;
		} else {
			$branches = array(array(
				'type' => null
			));
			return $branches;
		}
	}

	protected function set_branches () {
		$model = new Models\StaffModel();
		if ( ($branches = $model->get_all_branches()) ) {
			$_SESSION['staff']['branches'] = $branches;
		} else {
			$_SESSION['staff']['branches'] = array();
			$branch = array(
				'id' => '0',
				'z_id' => '0',
				'auth_id' => 'ID',
				'auth_name' => 'NAME',
				'timestamp' => '0',
				'time' => '0',
				'type' => '0',
				'summ' => '0'
			);
			array_push($_SESSION['staff']['branches'], $branch);
		}
	}

	protected function set_balances () {
		$model = new Models\StaffModel();
		if ( ($balances = $model->get_all_balances()) ) {
			$_SESSION['staff']['balances'] = $balances;
		} else {
			$_SESSION['staff']['balances'] = array();
			$balance = array (
				'id' => '0',
				'auth_id' => 'ID',
				'auth_name' => 'NAME',
				'timestamp' => '0',
				'time' => '0',
				'summ' => '0'
			);
			array_push($_SESSION['staff']['balances'], $balance);
		}
	}

	public function get_staff_check () {
		if (empty($_SESSION['staff'])) {
			$_SESSION['staff'] = array();
		} elseif (isset($_POST['staff_branch_summ']) and is_numeric($_POST['staff_branch_summ'])) {
			$this->prepare_branch_registration();
		} elseif (isset($_GET['staff_balance'])) {
			$this->set_balance();
		}
		$this->set_balances();
		$this->set_branches();
		$this->view_staff();
	}
}
