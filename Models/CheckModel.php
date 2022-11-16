<?php
namespace Models;
use Logics;

class CheckModel {
	public function get_check_registration ($auth_id, $auth_name, $time, $summ, $body, $received_cash, $received_card, $change) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO checks (
			auth_id,
			auth_name,
			`timestamp`,
			summ,
			body,
			received_cash,
			received_card,
			`change`) VALUES (
			'$auth_id', '$auth_name', '$time', '$summ', '$body', '$received_cash', '$received_card', '$change'
		)";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}