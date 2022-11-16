<?php
namespace Models;
use Logics;

class CheckModel {
	public function get_check ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM checks WHERE $search_p= '$search_v'";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['change'] = abs($record['change']);
			$record['main'] = unserialize($record['body']);
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			return $record;
		}
	}

	public function get_all_checks () {
		$checks = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, auth_id, auth_name, `timestamp`, summ FROM checks ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			array_push($checks, $record);
		}
		return $checks;
	}

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