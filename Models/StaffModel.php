<?php
namespace Models;
use Logics;

class StaffModel extends CheckModel {
	public function get_last_z_data () {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, balance_close FROM balances ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		return mysqli_fetch_assoc($result);
	}
	
	public function get_branch ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM branches WHERE $search_p= '$search_v'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			return $record;
		}
	}
	
	public function get_balance ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM balances WHERE $search_p= '$search_v'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
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
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			$branches[] = $record;
		}
		return $branches;
	}

	public function get_all_branches () {
		$branches = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM branches ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			$branches[] = $record;
		}
		return $branches;
	}

	public function get_all_balances () {
		$balances = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, auth_id, auth_name, `timestamp`, sum FROM balances ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			$balances[] = $record;
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
		$i18 = $data['sale_sum_cash'];
		$i19 = $data['sale_sum_card'];
		$i20 = $data['sale_sum'];
		$i21 = $data['sale_sum_a'];
		$i22 = $data['sale_sum_b'];
		$i23 = $data['sale_sum_v'];
		$i24 = $data['sale_sum_g'];
		$i25 = $data['sale_sum_m'];
		$i26 = $data['sale_sum_tax_a'];
		$i27 = $data['sale_sum_tax_b'];
		$i28 = $data['sale_sum_tax_v'];
		$i29 = $data['sale_sum_tax_g'];
		$i30 = $data['sale_sum_tax_m'];
		$i31 = $data['sale_sum_tax'];
		$i32 = $data['return_id_first'];
		$i33 = $data['return_id_last'];
		$i34 = $data['return_timestamp_first'];
		$i35 = $data['return_timestamp_last'];
		$i36 = $data['return_checks'];
		$i37 = $data['return_received_cash'];
		$i38 = $data['return_received_card'];
		$i39 = $data['return_change'];
		$i40 = $data['return_sum_cash'];
		$i41 = $data['return_sum_card'];
		$i42 = $data['return_sum'];
		$i43 = $data['return_sum_a'];
		$i44 = $data['return_sum_b'];
		$i45 = $data['return_sum_v'];
		$i46 = $data['return_sum_g'];
		$i47 = $data['return_sum_m'];
		$i48 = $data['return_sum_tax_a'];
		$i49 = $data['return_sum_tax_b'];
		$i50 = $data['return_sum_tax_v'];
		$i51 = $data['return_sum_tax_g'];
		$i52 = $data['return_sum_tax_m'];
		$i53 = $data['return_sum_tax'];
		$i54 = $data['sum_cash'];
		$i55 = $data['sum_card'];
		$i56 = $data['sum'];
		$i57 = $data['balance_open'];
		$i58 = $data['balance_close'];
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
			sale_sum_cash,
			sale_sum_card,
			sale_sum,
			sale_sum_a,
			sale_sum_b,
			sale_sum_v,
			sale_sum_g,
			sale_sum_m,
			sale_sum_tax_a,
			sale_sum_tax_b,
			sale_sum_tax_v,
			sale_sum_tax_g,
			sale_sum_tax_m,
			sale_sum_tax,
			return_id_first,
			return_id_last,
			return_timestamp_first,
			return_timestamp_last,
			return_checks,
			return_received_cash,
			return_received_card,
			return_change,
			return_sum_cash,
			return_sum_card,
			return_sum,
			return_sum_a,
			return_sum_b,
			return_sum_v,
			return_sum_g,
			return_sum_m,
			return_sum_tax_a,
			return_sum_tax_b,
			return_sum_tax_v,
			return_sum_tax_g,
			return_sum_tax_m,
			return_sum_tax,
			sum_cash,
			sum_card,
			sum,
			balance_open,
			balance_close)
			VALUES
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19', '$i20', '$i21', '$i22', '$i23', '$i24', '$i25', '$i26', '$i27', '$i28', '$i29', '$i30', '$i31', '$i32', '$i33', '$i34', '$i35', '$i36', '$i37', '$i38', '$i39', '$i40', '$i41', '$i42', '$i43', '$i44', '$i45', '$i46', '$i47', '$i48', '$i49', '$i50', '$i51', '$i52', '$i53', '$i54', '$i55', '$i56', '$i57', '$i58')";
		return mysqli_query($connection, $request);
	}

	public function get_branch_registration ($z_id, $auth_id, $auth_name, $time, $type, $sum) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO branches (
			z_id,
			auth_id,
			auth_name,
			`timestamp`,
			`type`,
			sum) VALUES (
			'$z_id', '$auth_id', '$auth_name', '$time', '$type', '$sum'
		)";
		return mysqli_query($connection, $request);
	}
}