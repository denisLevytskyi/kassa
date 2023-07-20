<?php
namespace Controllers;
use Logics\Connection;
use Views;
use Models;

class BaseController {
	protected function view_base () {
		$view = new Views\View();
		$view->view_template('base');
	}

	protected function view_check () {
		$view = new Views\View();
		$view->view_template('check');
	}

	protected function view_branch () {
		$view = new Views\View();
		$view->view_template('branch');
	}

	protected function view_balance () {
		$view = new Views\View();
		$view->view_template('balance');
	}

	protected function set_checks() {
		$model = new Models\BaseModel();
		if ( ($checks = $model->get_all_base_checks()) ) {
			$_SESSION['base']['checks'] = $checks;
		} else {
			$_SESSION['base']['checks'] = array();
			$checks = array (
					'id' => 0,
					'i_id' => 0,
					'z_id' => 0,
					'auth_id' => 'ID',
					'auth_name' => 'NAME',
					'timestamp' => 0,
					'time' => 0,
					'store_kass' => 0,
					'type' => 0,
					'sum' => 0
			);
			$_SESSION['base']['checks'][] = $checks;
		}
	}

	protected function set_balances () {
		$model = new Models\BaseModel();
		if ( ($balances = $model->get_all_base_balances()) ) {
			$_SESSION['base']['balances'] = $balances;
		} else {
			$_SESSION['base']['balances'] = array();
			$balance = array (
					'id' => 0,
					'i_id' => 0,
					'auth_id' => 'ID',
					'auth_name' => 'NAME',
					'timestamp' => 0,
					'time' => 0,
					'store_kass' => 0,
					'sum' => 0
			);
			$_SESSION['base']['balances'][] = $balance;
		}
	}

	protected function set_branches() {
		$model = new Models\BaseModel();
		if ( ($branches = $model->get_all_base_branches()) ) {
			$_SESSION['base']['branches'] = $branches;
		} else {
			$_SESSION['base']['branches'] = array();
			$branch = array(
					'id' => 0,
					'i_id' => 0,
					'z_id' => 0,
					'auth_id' => 'ID',
					'auth_name' => 'NAME',
					'timestamp' => 0,
					'time' => 0,
					'store_kass' => 0,
					'type' => 0,
					'sum' => 0
			);
			$_SESSION['base']['branches'][] = $branch;
		}
	}

	protected function set_view_doc ($type, $id) {
		$error = FALSE;
		$model = new Models\BaseModel();
		session_start();
		if ($type == 'check') {
			if ( ($check = $model->get_base_check('id', $id)) ) {
				$_SESSION['check'] = $check;
				$this->view_check();
			} else {
				$error = TRUE;
			}
		} elseif ($type == 'branch') {
			if ( ($branch = $model->get_base_branch('id', $id)) ) {
				$_SESSION['branch'] = $branch;
				$this->view_branch();
			} else {
				$error = TRUE;
			}
		} elseif ($type == 'balance') {
			if ( ($balance = $model->get_base_balance('id', $id)) ) {
				$_SESSION['balance'] = $balance;
				$this->view_balance();
			} else {
				$error = TRUE;
			}
		} else {
			$error = TRUE;
		}
		if ($error) {
			ErrorController::get_view_error(40);
		}
		die();
	}

	protected function truncate_base () {
		$admin = new AdminController();
		$admin->get_admin_check(11);
		$model = new Models\MoonModel();
		$result = array();
		$result_string = '';
		$result['checks'] = $model->get_truncate('base_checks', TRUE);
		$result['branches'] = $model->get_truncate('base_branches', TRUE);
		$result['balances'] = $model->get_truncate('base_balances', TRUE);
		foreach ($result as $k => $v) {
			$result_string .= "\\n	$k => " . ($v ? "OK" : "FAIL");
		} ?>
		<script>
			console.log('<?php echo "TRUNCATE BASE: $result_string"; ?>');
		</script>
	<?php }

	protected function send_chanel_request ($host) {
		$data = array(
				'terminal_key' => 1,
				'terminal_code' => 4,
				'terminal_data' => ''
		);
		$model = new Models\MoonModel();
		if ( ($result = $model->get_request($host, $data)) ) { ?>
			<script>
				console.log('<?php echo "CANCEL DOCUMENTS: $host => $result"; ?>');
			</script>
		<?php }
	}

	protected function chanel_docs_by_host () {
		$admin = new AdminController();
		$admin->get_admin_check(11);
		$host_list = Connection::base_list;
		foreach ($host_list as $k => $v) {
			$this->send_chanel_request($v);
		}
	}

	protected function send_setting_request ($host) {
		$model1 = new Models\AuthModel();
		$model2 = new Models\ProductModel();
		$model3 = new Models\PriceModel();
		$users = $model1->get_all_users();
		$products = $model2->get_all_products(TRUE);
		$prices = $model3->get_all_prices();
		$data = array(
				'terminal_key' => 1,
				'terminal_code' => 3,
				'terminal_data' => serialize(array(
						'users' => $users,
						'products' => $products,
						'prices' => $prices
				))
		);
		$model = new Models\MoonModel();
		if ( ($result = $model->get_request($host, $data)) ) { ?>
			<script>
				console.log('<?php echo "SET DOCUMENTS: $host => $result"; ?>');
			</script>
		<?php }
	}

	protected function set_docs_by_host () {
		$host_list = Connection::base_list;
		$self = Connection::base_url;
		foreach ($host_list as $k => $v) {
			if ($self != $v) {
				$this->send_setting_request($v);
			}
		}
	}

	protected function send_confirm_receipt ($type, $host, $id) {
		$data = array(
			'terminal_key' => 1,
			'terminal_code' => 2,
			'terminal_data' => [
				'type' => $type,
				'id' => $id
			]
		);
		$model = new Models\MoonModel();
		if ( ($result = $model->get_request($host, $data)) ) { ?>
			<script>
				console.log('<?php echo $result; ?>');
			</script>
		<?php }
	}

	protected function set_docs_registration ($type, $host, $data) {
		$model = new Models\BaseModel();
		foreach ($data as $k => $v) {
			$result = FALSE;
			if ($type == 'checks') {
				$result = $model->get_base_check_registration($v);
			} elseif ($type == 'branches') {
				$result = $model->get_base_branch_registration($v);
			} elseif ($type == 'balances') {
				$result = $model->get_base_balance_registration($v);
			}
			if ($result) {
				$this->send_confirm_receipt($type, $host, $v['id']);
			}
		}
	}

	protected function get_docs_from_answer ($host, $data) {
		$data = unserialize($data);
		foreach ($data as $k => $v) {
			$this->set_docs_registration($k, $host, $v);
		}
	}

	protected function send_getting_request ($host) {
		$data = array(
			'terminal_key' => 1,
			'terminal_code' => 1,
			'terminal_data' => ''
		);
		$model = new Models\MoonModel();
		if ( ($result = $model->get_request($host, $data)) ) {
			$this->get_docs_from_answer($host, $result);
		}
	}

	protected function get_docs_by_host () {
		$host_list = Connection::base_list;
		foreach ($host_list as $k => $v) { ?>
			<script>
				console.log('<?php echo "SET DOCUMENTS: $v =>"; ?>');
			</script> <?php
			$this->send_getting_request($v);
		}
	}

	public function get_base_check () {
		if (!Connection::base_factor) {
			ErrorController::get_view_error(39);
		} elseif (isset($_GET['base_get'])) {
			$this->get_docs_by_host();
		} elseif (isset($_GET['base_set'])) {
			$this->set_docs_by_host();
		} elseif (isset($_GET['base_cancel'])) {
			$this->chanel_docs_by_host();
		} elseif (isset($_GET['base_truncate'])) {
			$this->truncate_base();
		} elseif (isset($_GET['base_view']) and isset($_GET['base_view_id'])) {
			$this->set_view_doc($_GET['base_view'], $_GET['base_view_id']);
		}
		$this->set_branches();
		$this->set_balances();
		$this->set_checks();
		$this->view_base();
	}
}