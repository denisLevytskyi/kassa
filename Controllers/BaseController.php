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
					'type' => 0,
					'sum' => 0
			);
			$_SESSION['base']['checks'][] = $checks;
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
					'type' => 0,
					'sum' => 0
			);
			$_SESSION['base']['branches'][] = $branch;
		}
	}

	protected function set_setting_request ($host) {
		$model1 = new Models\AuthModel();
		$model2 = new Models\ProductModel();
		$model3 = new Models\PriceModel();
		$users = $model1->get_all_users();
		$products = $model2->get_all_products(TRUE);
		$prices = $model3->get_all_prices();
		$data = array(
				'terminal_key' => 1,
				'terminal_code' => 3,
				'terminal_data' => array(
						'users' => $users,
						'products' => $products,
						'prices' => $prices
				)
		);
		$model = new Models\MoonModel();
		if ( ($result = $model->get_request($host, $data)) ) { ?>
			<script>
				console.log('<?php echo "$host => $result"; ?>');
			</script>
		<?php }
	}


	protected function set_docs_by_host () {
		$host_list = Connection::base_list;
		foreach ($host_list as $k => $v) {
			$this->set_setting_request($v);
		}
	}

	protected function send_answer ($type, $host, $id) {
		$data = array(
			'terminal_key' => 1,
			'terminal_code' => 2,
			'terminal_data' => [
				'type' => $type,
				'id' => $id
			]
		);
		$model = new Models\MoonModel();
		$result = $model->get_request($host, $data);
		if ($result == 1) { ?>
			<script>
				console.log('<?php echo "$host => $type => #$id OK"; ?>');
			</script>
		<?php }
	}

	protected function set_docs_registration ($type, $host, $data) {
		$data = unserialize($data);
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
				$this->send_answer($type, $host, $v['id']);
			}
		}
	}

	protected function set_getting_request ($type, $host) {
		$data = array(
			'terminal_key' => 1,
			'terminal_code' => 1,
			'terminal_data' => $type
		);
		$model = new Models\MoonModel();
		if ( ($result = $model->get_request($host, $data)) ) {
			$this->set_docs_registration($type, $host, $result);
		}
	}

	protected function get_docs_by_host ($type) {
		$host_list = Connection::base_list;
		foreach ($host_list as $k => $v) {
			$this->set_getting_request($type, $v);
		}
	}

	protected function get_docs_by_type () {
		$type_list = array(
			'checks',
			'branches',
			'balances'
		);
		foreach ($type_list as $k => $v) {
			$this->get_docs_by_host($v);
		}
	}

	public function get_base_check () {
		if (isset($_GET['base_get'])) {
			$this->get_docs_by_type();
		} elseif (isset($_GET['base_set'])) {
			$this->set_docs_by_host();
		}
		$this->set_branches();
		$this->set_checks();
		$this->view_base();
	}
}