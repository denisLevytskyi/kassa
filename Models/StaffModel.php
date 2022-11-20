<?php
namespace Models;
use Logics;

class StaffModel extends CheckModel {
	public function get_last_z_data () {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, balance_close FROM balances ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		return mysqli_fetch_assoc($rezult);
	}
	
	public function get_branch ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM branches WHERE $search_p= '$search_v'";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			return $record;
		}
	}
	
	public function get_balance ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM balances WHERE $search_p= '$search_v'";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			$record['time_open'] = date("y-m-d H:i:s", $record['timestamp_open']);
			$record['time_close'] = date("y-m-d H:i:s", $record['timestamp_close']);
			$record['type'] = 'Z';
			return $record;
		}
	}
	
	public function get_branches_by_z_id ($z_id) {
		$branches = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM branches WHERE z_id= '$z_id'";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			array_push($branches, $record);
		}
		return $branches;
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

	public function get_balance_registration ($data) {
		$i0 = $data['auth_id'];
		$i1 = $data['auth_name'];
		$i2 = $data['timestamp'];
		$i3 = $data['timestamp_open'];
		$i4 = $data['timestamp_close'];
		$i5 = $data['check_first'];
		$i6 = $data['check_last'];
		$i7 = $data['checks'];
		$i8 = $data['received_cash'];
		$i9 = $data['received_card'];
		$i10 = $data['change'];
		$i11 = $data['summ'];
		$i12 = $data['summ_cash'];
		$i13 = $data['summ_card'];
		$i14 = $data['balance_open'];
		$i15 = $data['balance_close'];
		$i16 = $data['staff_in'];
		$i17 = $data['staff_out'];
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO balances (
			auth_id,
			auth_name,
			`timestamp`,
			timestamp_open,
			timestamp_close,
			check_first,
			check_last,
			checks,
			received_cash,
			received_card,
			`change`,
			summ,
			summ_cash,
			summ_card,
			balance_open,
			balance_close,
			staff_in,
			staff_out)
			VALUES
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17')";
		return mysqli_query($connection, $request);
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
		return mysqli_query($connection, $request);
	}
}