<?php
namespace Controllers;
use Views;
use Models;

class CustomerScoreboardController {
	protected function view_scoreboard () {
		$view = new Views\View();
		$view->view_template('customerScoreboard');
	}

	protected function set_scoreboard_data () {
		if (isset($_SESSION['unika']['list']) and !empty($_SESSION['unika']['list'])) {
			$product = end($_SESSION['unika']['list']);
			$data = array(
				'name' => $product['name'],
				'price' => $product['price'],
				'amount' => $product['amount'],
				'sum' => $product['sum'],
				'check_sum' => $_SESSION['unika']['sum']
			);
		} else {
			$data = array(
				'name' => '-',
				'price' => 0,
				'amount' => 0,
				'sum' => 0,
				'check_sum' => 0
			);
		}
		$_SESSION['scoreboard'] = $data;
	}

	public function get_scoreboard (){
		$this->set_scoreboard_data();
		$this->view_scoreboard();
	}
}