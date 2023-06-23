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

	protected function get_answer ($type, $host, $id) {
		$data = array(
			'terminal_key' => 1,
			'terminal_code' => 2,
			'terminal_data' => [
				'type' => $type,
				'id' => $id
			]
		);
		$model = new Models\BaseModel();
		echo $model->get_request($host, $data);
	}

	protected function set_docs_registration ($type, $host, $data) {
		$data = unserialize($data);
		$model = new Models\BaseModel();
		foreach ($data as $k => $v) {
			if ($type == 'checks') {
				if ( ($model->get_base_check_registration($v)) ) {
					$this->get_answer($type, $host, $v['id']);
				}
			} elseif ($type == 'branches') {


			} elseif ($type == 'balances') {

			}
		}
	}

	protected function set_request ($type, $host) {
		$data = array(
			'terminal_key' => 1,
			'terminal_code' => 1,
			'terminal_data' => $type
		);
		$model = new Models\BaseModel();
		if ( ($result = $model->get_request($host, $data)) ) {
			$this->set_docs_registration($type, $host, $result);
		}
	}

	protected function get_docs_by_host ($type) {
		$host_list = Connection::base_list;
		foreach ($host_list as $k => $v) {
			$this->set_request($type, $v);
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
		}
		$this->view_base();
	}
}