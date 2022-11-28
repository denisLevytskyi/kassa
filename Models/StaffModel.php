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
			$record['null_time_first'] = date("y-m-d H:i:s", $record['null_timestamp_first']);
			$record['null_time_last'] = date("y-m-d H:i:s", $record['null_timestamp_last']);
			$record['sale_time_first'] = date("y-m-d H:i:s", $record['sale_timestamp_first']);
			$record['sale_time_last'] = date("y-m-d H:i:s", $record['sale_timestamp_last']);
			$record['return_time_first'] = date("y-m-d H:i:s", $record['return_timestamp_first']);
			$record['return_time_last'] = date("y-m-d H:i:s", $record['return_timestamp_last']);
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
		$i3 = $data['staff_in'];
		$i4 = $data['staff_out'];
		$i5 = $data['null_id_first'];
		$i6 = $data['null_id_last'];
		$i7 = $data['null_timestamp_first'];
		$i8 = $data['null_timestamp_last'];
		$i9 = $data['null_checks'];
		$i10 = $data['sale_id_first'];
		$i11 = $data['sale_id_last'];
		$i12 = $data['sale_timestamp_first'];
		$i13 = $data['sale_timestamp_last'];
		$i14 = $data['sale_checks'];
		$i15 = $data['sale_received_cash'];
		$i16 = $data['sale_received_card'];
		$i17 = $data['sale_change'];
		$i18 = $data['sale_summ_cash'];
		$i19 = $data['sale_summ_card'];
		$i20 = $data['sale_summ'];
		$i21 = $data['return_id_first'];
		$i22 = $data['return_id_last'];
		$i23 = $data['return_timestamp_first'];
		$i24 = $data['return_timestamp_last'];
		$i25 = $data['return_checks'];
		$i26 = $data['return_received_cash'];
		$i27 = $data['return_received_card'];
		$i28 = $data['return_change'];
		$i29 = $data['return_summ_cash'];
		$i30 = $data['return_summ_card'];
		$i31 = $data['return_summ'];
		$i32 = $data['summ_cash'];
		$i33 = $data['summ_card'];
		$i34 = $data['summ'];
		$i35 = $data['balance_open'];
		$i36 = $data['balance_close'];
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO balances (
			auth_id,
			auth_name,
			`timestamp`,
			staff_in,
			staff_out,
			null_id_first,
			null_id_last,
			null_timestamp_first,
			null_timestamp_last,
			null_checks,
			sale_id_first,
			sale_id_last,
			sale_timestamp_first,
			sale_timestamp_last,
			sale_checks,
			sale_received_cash,
			sale_received_card,
			sale_change,
			sale_summ_cash,
			sale_summ_card,
			sale_summ,
			return_id_first,
			return_id_last,
			return_timestamp_first,
			return_timestamp_last,
			return_checks,
			return_received_cash,
			return_received_card,
			return_change,
			return_summ_cash,
			return_summ_card,
			return_summ,
			summ_cash,
			summ_card,
			summ,
			balance_open,
			balance_close)
			VALUES
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19', '$i20', '$i21', '$i22', '$i23', '$i24', '$i25', '$i26', '$i27', '$i28', '$i29', '$i30', '$i31', '$i32', '$i33', '$i34', '$i35', '$i36')";
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