<?php
namespace Controllers;
use Views;
use Models;

class StaffController {
	protected function view_staff () {
		$view = new Views\View();
		$view->view_staff();
	}

	protected function set_z_id () {
		$model = new Models\StaffModel();
		if ( ($rezult = $model->get_last_z_data()) ) {
			return $rezult['id'] + 1;
		} else {
			return 1;
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
			$type = 'OUT';
		} elseif ($summ > 0) {
			$type = 'IN';
		}
		if ( ($model->get_branch_registration($z_id, $auth_id, $auth_name, $time, $type, $summ)) ) {
			header("Location: /staff.php", true, 303);
		} else {
			ErrorController::get_view_error(24);
		}
	}

	protected function set_branches () {
		$model = new Models\StaffModel();
		if ( ($branches = $model->get_all_branches()) ) {
			$_SESSION['staff']['branches'] = $branches;
		} else {
			$_SESSION['staff']['branches'] = array();
			$branches = array (
				'id' => '0',
				'z_id' => '0',
				'auth_id' => 'ID',
				'auth_name' => 'NAME',
				'timestamp' => '0',
				'time' => '0',
				'summ' => '0',
				'type' => '0'
			);
			array_push($_SESSION['staff']['branches'], $branches);
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
			$this->set_branch_registration();
		}
		$this->set_balances();
		$this->set_branches();
		$this->view_staff();
	}
}