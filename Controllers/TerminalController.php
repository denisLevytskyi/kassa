<?php
namespace Controllers;
use Views;
use Models;

class TerminalController {
	protected function get_update ($type, $id) {
		$model = new Models\BaseModel();
		$model->get_factor_update($type, $id);
	}

	protected function get_data ($type) {
		if ($type == 'checks') {
			$model = new Models\CheckModel();
			$checks = $model->get_checks('base_factor', 0);
			echo serialize($checks);
		} elseif ($type == 'branches') {
			$model = new Models\StaffModel();
			$branches = $model->get_branches('base_factor', 0);
			echo serialize($branches);
		} elseif ($type == 'balances') {
			$model = new Models\StaffModel();
			$balances = $model->get_balances('base_factor', 0, 0);
			echo serialize($balances);
		}
	}

	public function get_terminal () {
		if (empty($_POST['terminal_key']) and $_POST['terminal_key'] != 1) {
			exit();
		}
		if (isset($_POST['terminal_code']) and isset($_POST['terminal_data']) and $_POST['terminal_code'] == 1) {
			$this->get_data($_POST['terminal_data']);
		} elseif (isset($_POST['terminal_code']) and isset($_POST['terminal_data']) and $_POST['terminal_code'] == 2) {
			$this->get_update($_POST['terminal_data']['type'], $_POST['terminal_data']['id']);
		}
	}
}