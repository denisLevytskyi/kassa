<?php
namespace Controllers;
use Views;
use Models;

class StaffController {
	protected function view_staff () {
		$view = new Views\View();
		$view->view_template('staff');
	}

	protected function view_balance () {
		ob_start();
		$data = 'Ksef/' . $_SESSION['balance']['timestamp'] . '_X-balance_№_' . $_SESSION['balance']['id'] . '.html';
		$view = new Views\View();
		$view->view_template('balance');
		$model = new Models\KsefModel();
		$model->get_document_registration($data);
	}

	protected function view_periodical () {
		ob_start();
		$data = 'Ksef/' . $_SESSION['balance']['timestamp'] . '_Periodical_№_' . $_SESSION['balance']['id'] . '.html';
		$view = new Views\View();
		$view->view_template('balance');
		$model = new Models\KsefModel();
		$model->get_document_registration($data);
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

	protected function set_z_balance_close () {
		$model = new Models\StaffModel();
		if ( ($result = $model->get_last_z_data()) ) {
			return $result['balance_close'];
		} else {
			return 0;
		}
	}

	protected function get_balance_fields () {
		$props = PropsController::get_data();
		return array(
			'auth_id' => $_SESSION['auth']['id'],
			'auth_name' => $_SESSION['auth']['name'],
			'timestamp' => time(),
			'organization_name' => $props['organization_name'],
			'store_name' => $props['store_name'],
			'store_address' => $props['store_address'],
			'store_kass' => $props['store_kass'],
			'num_fiskal' => $props['num_fiskal'],
			'num_factory' => $props['num_factory'],
			'num_id' => $props['num_id'],
			'num_tax' => $props['num_tax'],
			'staff_in' => 0,
			'staff_out' => 0,
			'null_id_first' => 0,
			'null_id_last' => 0,
			'null_timestamp_first' => time(),
			'null_timestamp_last' => time(),
			'null_checks' => 0,
			'sale_id_first' => 0,
			'sale_id_last' => 0,
			'sale_timestamp_first' => time(),
			'sale_timestamp_last' => time(),
			'sale_checks' => 0,
			'sale_received_cash' => 0,
			'sale_received_card' => 0,
			'sale_change' => 0,
			'sale_sum_cash' => 0,
			'sale_sum_card' => 0,
			'sale_sum' => 0,
			'sale_round_plus' => 0,
			'sale_round_minus' => 0,
			'sale_sum_a' => 0,
			'sale_sum_b' => 0,
			'sale_sum_v' => 0,
			'sale_sum_g' => 0,
			'sale_sum_m' => 0,
			'sale_sum_tax_a' => 0,
			'sale_sum_tax_b' => 0,
			'sale_sum_tax_v' => 0,
			'sale_sum_tax_g' => 0,
			'sale_sum_tax_m' => 0,
			'sale_sum_tax' => 0,
			'return_id_first' => 0,
			'return_id_last' => 0,
			'return_timestamp_first' => time(),
			'return_timestamp_last' => time(),
			'return_checks' => 0,
			'return_received_cash' => 0,
			'return_received_card' => 0,
			'return_change' => 0,
			'return_sum_cash' => 0,
			'return_sum_card' => 0,
			'return_sum' => 0,
			'return_round_plus' => 0,
			'return_round_minus' => 0,
			'return_sum_a' => 0,
			'return_sum_b' => 0,
			'return_sum_v' => 0,
			'return_sum_g' => 0,
			'return_sum_m' => 0,
			'return_sum_tax_a' => 0,
			'return_sum_tax_b' => 0,
			'return_sum_tax_v' => 0,
			'return_sum_tax_g' => 0,
			'return_sum_tax_m' => 0,
			'return_sum_tax' => 0,
			'sum_cash' => 0,
			'sum_card' => 0,
			'sum' => 0,
			'balance_open' => $this->set_z_balance_close(),
			'balance_close' => 0
		);
	}
	
	protected function set_checks_by_z_id ($z_id) {
		$model = new Models\CheckModel();
		if ( ($checks = $model->get_checks('z_id', $z_id)) ) {
			return $checks;
		} else {
			return array(array(
				'type' => null
			));
		}
	}
	
	protected function set_branches_by_z_id ($z_id) {
		$model = new Models\StaffModel();
		if ( ($branches = $model->get_branches('z_id', $z_id)) ) {
			return $branches;
		} else {
			return array(array(
				'type' => null
			));
		}
	}

	protected function set_z_id () {
		$model = new Models\StaffModel();
		if ( ($result = $model->get_last_z_data()) ) {
			return $result['id'] + 1;
		} else {
			return 1;
		}
	}

	protected function set_balance_data () {
		$gate0 = 0;
		$gate1 = 0;
		$gate2 = 0;
		$z_id = $this->set_z_id();
		$b_data = $this->set_branches_by_z_id($z_id);
		$c_data = $this->set_checks_by_z_id($z_id);
		$data = $this->get_balance_fields();
		foreach ($b_data as $k => $v) {
			if ($v['type'] == 'СЛУЖБОВЕ ВИЛУЧЕННЯ') {
				$data['staff_out'] += $v['sum'];
			} elseif ($v['type'] == 'СЛУЖБОВЕ ВНЕСЕННЯ') {
				$data['staff_in'] += $v['sum'];
			}
		}
		foreach ($c_data as $k => $v) {
			if ($v['type'] == 'АНУЛЬОВАНО') {
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
				if (isset($v['main']['round'])) {
					if ($v['main']['round']['sum'] > 0) {
						$data['sale_round_plus'] += $v['main']['round']['sum'];
					} else {
						$data['sale_round_minus'] += -$v['main']['round']['sum'];
					}
				}
				$data['sale_id_last'] = $v['id'];
				$data['sale_timestamp_last'] = $v['timestamp'];
				$data['sale_checks'] += 1;
				$data['sale_received_cash'] += $v['received_cash'];
				$data['sale_received_card'] += $v['received_card'];
				$data['sale_change'] += $v['change'];
				$data['sale_sum_cash'] += $v['sum_cash'];
				$data['sale_sum_card'] += $v['sum_card'];
				$data['sale_sum'] += $v['sum'];
				$data['sale_sum_a'] += $v['sum_a'];
				$data['sale_sum_b'] += $v['sum_b'];
				$data['sale_sum_v'] += $v['sum_v'];
				$data['sale_sum_g'] += $v['sum_g'];
				$data['sale_sum_m'] += $v['sum_m'];
				$data['sale_sum_tax_a'] += $v['sum_tax_a'];
				$data['sale_sum_tax_b'] += $v['sum_tax_b'];
				$data['sale_sum_tax_v'] += $v['sum_tax_v'];
				$data['sale_sum_tax_g'] += $v['sum_tax_g'];
				$data['sale_sum_tax_m'] += $v['sum_tax_m'];
			} elseif ($v['type'] == 'ВИДАТКОВИЙ ЧЕК') {
				if ($gate2 == 0) {
					$data['return_id_first'] = $v['id'];
					$data['return_timestamp_first'] = $v['timestamp'];
					$gate2 = 1;
				}
				if (isset($v['main']['round'])) {
					if ($v['main']['round']['sum'] > 0) {
						$data['return_round_plus'] += $v['main']['round']['sum'];
					} else {
						$data['return_round_minus'] += -$v['main']['round']['sum'];
					}
				}
				$data['return_id_last'] = $v['id'];
				$data['return_timestamp_last'] = $v['timestamp'];
				$data['return_checks'] += 1;
				$data['return_received_cash'] += $v['received_cash'];
				$data['return_received_card'] += $v['received_card'];
				$data['return_change'] += $v['change'];
				$data['return_sum_cash'] += $v['sum_cash'];
				$data['return_sum_card'] += $v['sum_card'];
				$data['return_sum'] += $v['sum'];
				$data['return_sum_a'] += $v['sum_a'];
				$data['return_sum_b'] += $v['sum_b'];
				$data['return_sum_v'] += $v['sum_v'];
				$data['return_sum_g'] += $v['sum_g'];
				$data['return_sum_m'] += $v['sum_m'];
				$data['return_sum_tax_a'] += $v['sum_tax_a'];
				$data['return_sum_tax_b'] += $v['sum_tax_b'];
				$data['return_sum_tax_v'] += $v['sum_tax_v'];
				$data['return_sum_tax_g'] += $v['sum_tax_g'];
				$data['return_sum_tax_m'] += $v['sum_tax_m'];
			}
		}
		$data['sale_sum_tax'] = (
			$data['sale_sum_tax_a'] +
			$data['sale_sum_tax_b'] +
			$data['sale_sum_tax_v'] +
			$data['sale_sum_tax_g'] +
			$data['sale_sum_tax_m']
		);
		$data['return_sum_tax'] = (
			$data['return_sum_tax_a'] +
			$data['return_sum_tax_b'] +
			$data['return_sum_tax_v'] +
			$data['return_sum_tax_g'] +
			$data['return_sum_tax_m']
		);
		$data['sum_cash'] = $data['sale_sum_cash'] - $data['return_sum_cash'];
		$data['sum_card'] = $data['sale_sum_card'] - $data['return_sum_card'];
		$data['sum'] = $data['sale_sum'] - $data['return_sum'];
		$data['balance_close'] = abs($data['balance_open'] + $data['sum_cash'] + $data['staff_in'] - $data['staff_out']);
		foreach ($data as $k => $v) {
			if (is_numeric($v)) {
				$data[$k] = round($v, 2);
			}
		}
		return $data;
	}

	protected function set_balance () {
		$data = $this->set_balance_data();
		if ($_GET['staff_balance'] == 'X') {
			session_start();
			$_SESSION['balance'] = $data;
			$_SESSION['balance']['id'] = $this->set_z_id();
			$_SESSION['balance']['type'] = $_GET['staff_balance'];
			$_SESSION['balance']['time'] = date("d-m-Y H:i:s", $data['timestamp']);
			$_SESSION['balance']['null_time_first'] = date("d-m-Y H:i:s", $data['null_timestamp_first']);
			$_SESSION['balance']['null_time_last'] = date("d-m-Y H:i:s", $data['null_timestamp_last']);
			$_SESSION['balance']['sale_time_first'] = date("d-m-Y H:i:s", $data['sale_timestamp_first']);
			$_SESSION['balance']['sale_time_last'] = date("d-m-Y H:i:s", $data['sale_timestamp_last']);
			$_SESSION['balance']['return_time_first'] = date("d-m-Y H:i:s", $data['return_timestamp_first']);
			$_SESSION['balance']['return_time_last'] = date("d-m-Y H:i:s", $data['return_timestamp_last']);
			$this->view_balance();
			exit();
		} elseif ($_GET['staff_balance'] == 'Z') {
			$this->set_balance_registration($data);
		}
	}

	protected function set_periodical_data () {
		$data = $this->get_balance_fields();
		$error = FALSE;
		$gate0 = 0;
		$gate1 = 0;
		$gate2 = 0;
		$gate3 = 0;
		if (strtotime($_POST['staff_periodical_f'])) {
			$first = strtotime($_POST['staff_periodical_f']);
			$last = strtotime($_POST['staff_periodical_l']) + 86400;
			$search = 'timestamp';
		} else {
			$first = $_POST['staff_periodical_f'];
			$last = $_POST['staff_periodical_l'];
			$search = 'id';
		}
		$model = new Models\StaffModel();
		$balances = $model->get_balances($search, $first, $last);
		if (empty($balances)) {
			ErrorController::get_view_error(31);
			die();
		} else {
			$z_id_first = $balances[array_key_first($balances)]['id'];
			$z_id_last = $balances[array_key_last($balances)]['id'];
			$data['id'] = $z_id_first . '-' . $z_id_last;
		}
		foreach ($balances as $k => $v) {
			if ($z_id_first != $v['id'] and $data['organization_name'] != $v['organization_name']) {
				$error = TRUE;
			} elseif ($z_id_first != $v['id'] and $data['store_name'] != $v['store_name']) {
				$error = TRUE;
			} elseif ($z_id_first != $v['id'] and $data['store_address'] != $v['store_address']) {
				$error = TRUE;
			} elseif ($z_id_first != $v['id'] and $data['num_fiskal'] != $v['num_fiskal']) {
				$error = TRUE;
			} elseif ($z_id_first != $v['id'] and $data['num_factory'] != $v['num_factory']) {
				$error = TRUE;
			} elseif ($z_id_first != $v['id'] and $data['num_id'] != $v['num_id']) {
				$error = TRUE;
			} elseif ($z_id_first != $v['id'] and $data['num_tax'] != $v['num_tax']) {
				$error = TRUE;
			}
			if ($gate0 == 0 and $v['null_id_first'] != 0) {
				$data['null_id_first'] = $v['null_id_first'];
				$data['null_timestamp_first'] = $v['null_timestamp_first'];
				$gate0 = 1;
			}
			if ($gate1 == 0 and $v['sale_id_first'] != 0) {
				$data['sale_id_first'] = $v['sale_id_first'];
				$data['sale_timestamp_first'] = $v['sale_timestamp_first'];
				$gate1 = 1;
			}
			if ($gate2 == 0 and $v['return_id_first'] != 0) {
				$data['return_id_first'] = $v['return_id_first'];
				$data['return_timestamp_first'] = $v['return_timestamp_first'];
				$gate2 = 1;
			}
			if ($gate3 == 0) {
				$data['balance_open'] = $v['balance_open'];
				$gate3 = 1;
			}
			if ($v['null_id_last'] != 0) {
				$data['null_id_last'] = $v['null_id_last'];
				$data['null_timestamp_last'] = $v['null_timestamp_last'];
			}
			if ($v['sale_id_last'] != 0) {
				$data['sale_id_last'] = $v['sale_id_last'];
				$data['sale_timestamp_last'] = $v['sale_timestamp_last'];
			}
			if ($v['return_id_last'] != 0) {
				$data['return_id_last'] = $v['return_id_last'];
				$data['return_timestamp_last'] = $v['return_timestamp_last'];
			}
			$data['organization_name'] = $v['organization_name'];
			$data['store_name'] = $v['store_name'];
			$data['store_address'] = $v['store_address'];
			$data['store_kass'] = $v['store_kass'];
			$data['num_fiskal'] = $v['num_fiskal'];
			$data['num_factory'] = $v['num_factory'];
			$data['num_id'] = $v['num_id'];
			$data['num_tax'] = $v['num_tax'];
			$data['staff_in'] += $v['staff_in'];
			$data['staff_out'] += $v['staff_out'];
			$data['null_checks'] += $v['null_checks'];
			$data['sale_checks'] += $v['sale_checks'];
			$data['sale_received_cash'] += $v['sale_received_cash'];
			$data['sale_received_card'] += $v['sale_received_card'];
			$data['sale_change'] += $v['sale_change'];
			$data['sale_sum_cash'] += $v['sale_sum_cash'];
			$data['sale_sum_card'] += $v['sale_sum_card'];
			$data['sale_sum'] += $v['sale_sum'];
			$data['sale_round_plus'] += $v['sale_round_plus'];
			$data['sale_round_minus'] += $v['sale_round_minus'];
			$data['sale_sum_a'] += $v['sale_sum_a'];
			$data['sale_sum_b'] += $v['sale_sum_b'];
			$data['sale_sum_v'] += $v['sale_sum_v'];
			$data['sale_sum_g'] += $v['sale_sum_g'];
			$data['sale_sum_m'] += $v['sale_sum_m'];
			$data['sale_sum_tax_a'] += $v['sale_sum_tax_a'];
			$data['sale_sum_tax_b'] += $v['sale_sum_tax_b'];
			$data['sale_sum_tax_v'] += $v['sale_sum_tax_v'];
			$data['sale_sum_tax_g'] += $v['sale_sum_tax_g'];
			$data['sale_sum_tax_m'] += $v['sale_sum_tax_m'];
			$data['sale_sum_tax'] += $v['sale_sum_tax'];
			$data['return_checks'] += $v['return_checks'];
			$data['return_received_cash'] += $v['return_received_cash'];
			$data['return_received_card'] += $v['return_received_card'];
			$data['return_change'] += $v['return_change'];
			$data['return_sum_cash'] += $v['return_sum_cash'];
			$data['return_sum_card'] += $v['return_sum_card'];
			$data['return_sum'] += $v['return_sum'];
			$data['return_round_plus'] += $v['return_round_plus'];
			$data['return_round_minus'] += $v['return_round_minus'];
			$data['return_sum_a'] += $v['return_sum_a'];
			$data['return_sum_b'] += $v['return_sum_b'];
			$data['return_sum_v'] += $v['return_sum_v'];
			$data['return_sum_g'] += $v['return_sum_g'];
			$data['return_sum_m'] += $v['return_sum_m'];
			$data['return_sum_tax_a'] += $v['return_sum_tax_a'];
			$data['return_sum_tax_b'] += $v['return_sum_tax_b'];
			$data['return_sum_tax_v'] += $v['return_sum_tax_v'];
			$data['return_sum_tax_g'] += $v['return_sum_tax_g'];
			$data['return_sum_tax_m'] += $v['return_sum_tax_m'];
			$data['return_sum_tax'] += $v['return_sum_tax'];
			$data['sum_cash'] += $v['sum_cash'];
			$data['sum_card'] += $v['sum_card'];
			$data['sum'] += $v['sum'];
			$data['balance_close'] = $v['balance_close'];
		}
		if ($error) {
			ErrorController::get_view_error(38);
			die();
		}
		return $data;
	}

	protected function set_periodical () {
		$admin = new AdminController();
		$admin->get_admin_check(4);
		$data = $this->set_periodical_data();
		session_start();
		$_SESSION['balance'] = $data;
		$_SESSION['balance']['type'] = 'ПЕРІОДИЧНИЙ<br>Z';
		$_SESSION['balance']['time'] = date("d-m-Y H:i:s", $data['timestamp']);
		$_SESSION['balance']['null_time_first'] = date("d-m-Y H:i:s", $data['null_timestamp_first']);
		$_SESSION['balance']['null_time_last'] = date("d-m-Y H:i:s", $data['null_timestamp_last']);
		$_SESSION['balance']['sale_time_first'] = date("d-m-Y H:i:s", $data['sale_timestamp_first']);
		$_SESSION['balance']['sale_time_last'] = date("d-m-Y H:i:s", $data['sale_timestamp_last']);
		$_SESSION['balance']['return_time_first'] = date("d-m-Y H:i:s", $data['return_timestamp_first']);
		$_SESSION['balance']['return_time_last'] = date("d-m-Y H:i:s", $data['return_timestamp_last']);
		$this->view_periodical();
		exit();
	}

	protected function set_branch_registration () {
		$props = PropsController::get_data();
		$data = array(
			'z_id' => $this->set_z_id(),
			'auth_id' => $_SESSION['auth']['id'],
			'auth_name' => $_SESSION['auth']['name'],
			'timestamp' => time(),
			'organization_name' => $props['organization_name'],
			'store_name' => $props['store_name'],
			'store_address' => $props['store_address'],
			'store_kass' => $props['store_kass'],
			'num_fiskal' => $props['num_fiskal'],
			'num_factory' => $props['num_factory'],
			'num_id' => $props['num_id'],
			'num_tax' => $props['num_tax'],
			'type' => "НУЛЬОВИЙ ЧЕК",
			'sum' => round($_POST['staff_branch_sum'], 2)
		);
		$model = new Models\StaffModel();
		if ($data['sum'] < 0) {
			$data['sum'] = -$data['sum'];
			$data['type'] = 'СЛУЖБОВЕ ВИЛУЧЕННЯ';
		} elseif ($data['sum'] > 0) {
			$data['type'] = 'СЛУЖБОВЕ ВНЕСЕННЯ';
		}
		if ( ($model->get_branch_registration($data)) ) {
			$branch = $model->get_branch('timestamp', $data['timestamp']);
			$branch_id = $branch['id'];
			header("Location: /branch.php/?branch_id=$branch_id");
		} else {
			ErrorController::get_view_error(24);
		}
	}

	protected function set_branch () {
		$sum = $_POST['staff_branch_sum'];
		$data = $this->set_balance_data();
		$result = $data['balance_close'] + $sum;
		if ($result >= 0 and ($result <= 100000 or $sum <= 0)) {
			$this->set_branch_registration();
		}
	}

	protected function set_balance_sum () {
		$data = $this->set_balance_data();
		$_SESSION['staff']['balance'] = $data['balance_close'];
	}

	protected function set_branches () {
		$model = new Models\StaffModel();
		if ( ($branches = $model->get_all_branches()) ) {
			$_SESSION['staff']['branches'] = $branches;
		} else {
			$_SESSION['staff']['branches'] = array();
			$branch = array(
				'id' => 0,
				'z_id' => 0,
				'auth_id' => 'ID',
				'auth_name' => 'NAME',
				'timestamp' => 0,
				'time' => 0,
				'type' => 0,
				'sum' => 0
			);
			$_SESSION['staff']['branches'][] = $branch;
		}
	}

	protected function set_balances () {
		$model = new Models\StaffModel();
		if ( ($balances = $model->get_all_balances()) ) {
			$_SESSION['staff']['balances'] = $balances;
		} else {
			$_SESSION['staff']['balances'] = array();
			$balance = array (
				'id' => 0,
				'auth_id' => 'ID',
				'auth_name' => 'NAME',
				'timestamp' => 0,
				'time' => 0,
				'sum' => 0
			);
			$_SESSION['staff']['balances'][] = $balance;
		}
	}

	public function get_staff_check () {
		if (empty($_SESSION['staff'])) {
			$_SESSION['staff'] = array();
		} elseif (isset($_POST['staff_branch_sum']) and is_numeric($_POST['staff_branch_sum'])) {
			$this->set_branch();
		} elseif (isset($_POST['staff_periodical_f']) and $_POST['staff_periodical_f'] <= $_POST['staff_periodical_l']) {
			$this->set_periodical();
		} elseif (isset($_GET['staff_balance'])) {
			$this->set_balance();
		}
		$this->set_balances();
		$this->set_branches();
		$this->set_balance_sum();
		$this->view_staff();
	}
}