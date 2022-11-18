<?php
namespace Models;
use Logics;

class StaffModel extends CheckModel {
	public function get_last_z_data () {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, balance_close FROM balances ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		$record = mysqli_fetch_assoc($rezult);
		return $record;
	}

	public function get_all_branches () {
		$branches = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM branches ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			array_push($branches, $record);
		}
		return $branches;
	}

	public function get_all_balances () {
		$balances = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, auth_id, auth_name, `timestamp`, summ FROM balances ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			array_push($balances, $record);
		}
		return $balances;
	}

	public function get_branch_registration ($z_id, $auth_id, $auth_name, $time, $type, $summ) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO branches (
			z_id,
			auth_id,
			auth_name,
			`timestamp`,
			`type`,
			summ) VALUES (
			'$z_id', '$auth_id', '$auth_name', '$time', '$type', '$summ'
		)";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}
