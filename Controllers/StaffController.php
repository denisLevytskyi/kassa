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
		$view = new Views\View();
		$view->view_balance();
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
		session_start();
		$_SESSION['balance'] = $data;
		$_SESSION['balance']['type'] = $_GET['staff_balance'];
		if ($_GET['staff_balance'] == 'X') {
			$_SESSION['balance']['id'] = $this->set_z_id();
			$_SESSION['balance']['time'] = date("y-m-d H:i:s", $data['timestamp']);
			$_SESSION['balance']['time_open'] = date("y-m-d H:i:s", $data['timestamp_open']);
			$_SESSION['balance']['time_close'] = date("y-m-d H:i:s", $data['timestamp_close']);
			$this->view_balance();
			exit();
		} elseif ($_GET['staff_balance'] == 'Z') {
			$this->set_balance_registration($data);
		}
	}
	
	protected function set_balance_data () {
		$gate = 0;
		$z_id = $this->set_z_id();
		$b_data = $this->set_branches_by_z_id($z_id);
		$c_data = $this->set_checks_by_z_id($z_id);
		$data = array(
			'auth_id' => $_SESSION['auth']['id'],
			'auth_name' => $_SESSION['auth']['name'],
			'timestamp' => time(),
			'timestamp_open' => time(),
			'timestamp_close' => time(),
			'check_first' => '0',
			'check_last' => '0',
			'checks' => '-',
			'received_cash' => 0,
			'received_card' => 0,
			'change' => 0,
			'summ' => 0,
			'summ_cash' => 0,
			'summ_card' => 0,
			'balance_open' => $this->set_z_balance_close(),
			'balance_close' => 0,
			'staff_in'  => 0,
			'staff_out'  => 0
		);
		foreach ($b_data as $k => $v) {
			if ($v['type'] == 'СЛУЖБОВЕ ВИЛУЧЕННЯ') {
				$data['staff_out'] = $data['staff_out'] + $v['summ'];
			} else {
				$data['staff_in'] = $data['staff_in'] + $v['summ'];
			}
		}
		foreach ($c_data as $k => $v) {
			if ($gate == 0) {
				$data['check_first'] = $v['id'];
				$data['timestamp_open'] = $v['timestamp'];
				$gate = 1;
			}
			$data['check_last'] = $v['id'];
			$data['timestamp_close'] = $v['timestamp'];
			$data['received_cash'] = $data['received_cash'] + $v['received_cash'];
			$data['received_card'] = $data['received_card'] + $v['received_card'];
			$data['change'] = $data['change'] + abs($v['change']);
			$data['summ'] = $data['summ'] + $v['summ'];
		}
		$data['checks'] = $data['check_last'] - $data['check_first'] + 1;
		$data['summ_card'] = $data['received_card'];
		$data['summ_cash'] = $data['received_cash'] - $data['change'];
		$data['balance_close'] = $data['balance_open'] + $data['summ_cash'] + $data['staff_in'] - $data['staff_out'];
		return $data;
	}

	protected function set_balance_registration ($data) {
		$model = new Models\StaffModel();
		if ( ($model->get_balance_registration($data)) ) {
			header("Location: /staff.php");
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
		$summ = round($_POST['staff_branch_summ'], 2);
		if ($summ < 0) {
			$summ = -$summ;
			$type = 'СЛУЖБОВЕ ВИЛУЧЕННЯ';
		} elseif ($summ > 0) {
			$type = 'СЛУЖБОВЕ ВНЕСЕННЯ';
		}
		if ( ($model->get_branch_registration($z_id, $auth_id, $auth_name, $time, $type, $summ)) ) {
			header("Location: /staff.php", true, 303);
		} else {
			ErrorController::get_view_error(24);
		}
	}
	
	protected function set_checks_by_z_id ($z_id) {
		$model = new Models\CheckModel();
		if ( ($checks = $model->get_checks_by_z_id($z_id)) ) {
			return $checks;
		} else {
			$checks = array();
			$check = array(
				'id' => 0,
				'timestamp' => time(),
				'summ' => 0,
				'received_cash' => 0,
				'received_card' => 0,
				'change' => 0
			);
			array_push($checks, $check);
			return $checks;
		}
	}
	
	protected function set_branches_by_z_id ($z_id) {
		$model = new Models\StaffModel();
		if ( ($branches = $model->get_branches_by_z_id($z_id)) ) {
			return $branches;
		} else {
			$branches = array();
			$branch = array(
				'summ' => '0',
				'type' => '0'
			);
			array_push($branches, $branch);
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
				'summ' => '0',
				'type' => '0'
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
		} elseif (isset($_POST['staff_branch_summ']) and is_numeric($_POST['staff_branch_summ']) and $_POST['staff_branch_summ'] != 0) {
			$this->prepare_branch_registration();
		} elseif (isset($_GET['staff_balance'])) {
			$this->set_balance();
		}
		$this->set_balances();
		$this->set_branches();
		$this->view_staff();
	}
}
