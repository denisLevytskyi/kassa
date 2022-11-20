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
	
	public function get_checks_by_z_id ($z_id) {
		$checks = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM checks WHERE z_id= '$z_id'";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			array_push($checks, $record);
		}
		return $checks;
	}

	public function get_all_checks () {
		$checks = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, z_id, auth_id, auth_name, `timestamp`, type, summ FROM checks ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			array_push($checks, $record);
		}
		return $checks;
	}

	public function get_check_registration ($z_id, $auth_id, $auth_name, $time, $type, $body, $received_cash, $received_card, $change, $summ) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO checks (
			z_id,
			auth_id,
			auth_name,
			`timestamp`,
			type,
			body,
			received_cash,
			received_card,
			`change`,
			summ)
			VALUES
			('$z_id', '$auth_id', '$auth_name', '$time', '$type', '$body', '$received_cash', '$received_card', '$change', '$summ')";
		return mysqli_query($connection, $request);
	}
}
