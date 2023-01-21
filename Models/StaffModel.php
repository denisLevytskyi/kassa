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
		$i3 = $data['organization_name'];
		$i4 = $data['store_name'];
		$i5 = $data['store_address'];
		$i6 = $data['store_kass'];
		$i7 = $data['num_fiskal'];
		$i8 = $data['num_factory'];
		$i9 = $data['num_id'];
		$i10 = $data['num_tax'];
		$i11 = $data['staff_in'];
		$i12 = $data['staff_out'];
		$i13 = $data['null_id_first'];
		$i14 = $data['null_id_last'];
		$i15 = $data['null_timestamp_first'];
		$i16 = $data['null_timestamp_last'];
		$i17 = $data['null_checks'];
		$i18 = $data['sale_id_first'];
		$i19 = $data['sale_id_last'];
		$i20 = $data['sale_timestamp_first'];
		$i21 = $data['sale_timestamp_last'];
		$i22 = $data['sale_checks'];
		$i23 = $data['sale_received_cash'];
		$i24 = $data['sale_received_card'];
		$i25 = $data['sale_change'];
		$i26 = $data['sale_sum_cash'];
		$i27 = $data['sale_sum_card'];
		$i28 = $data['sale_sum'];
		$i29 = $data['sale_sum_a'];
		$i30 = $data['sale_sum_b'];
		$i31 = $data['sale_sum_v'];
		$i32 = $data['sale_sum_g'];
		$i33 = $data['sale_sum_m'];
		$i34 = $data['sale_sum_tax_a'];
		$i35 = $data['sale_sum_tax_b'];
		$i36 = $data['sale_sum_tax_v'];
		$i37 = $data['sale_sum_tax_g'];
		$i38 = $data['sale_sum_tax_m'];
		$i39 = $data['sale_sum_tax'];
		$i40 = $data['return_id_first'];
		$i41 = $data['return_id_last'];
		$i42 = $data['return_timestamp_first'];
		$i43 = $data['return_timestamp_last'];
		$i44 = $data['return_checks'];
		$i45 = $data['return_received_cash'];
		$i46 = $data['return_received_card'];
		$i47 = $data['return_change'];
		$i48 = $data['return_sum_cash'];
		$i49 = $data['return_sum_card'];
		$i50 = $data['return_sum'];
		$i51 = $data['return_sum_a'];
		$i52 = $data['return_sum_b'];
		$i53 = $data['return_sum_v'];
		$i54 = $data['return_sum_g'];
		$i55 = $data['return_sum_m'];
		$i56 = $data['return_sum_tax_a'];
		$i57 = $data['return_sum_tax_b'];
		$i58 = $data['return_sum_tax_v'];
		$i59 = $data['return_sum_tax_g'];
		$i60 = $data['return_sum_tax_m'];
		$i61 = $data['return_sum_tax'];
		$i62 = $data['sum_cash'];
		$i63 = $data['sum_card'];
		$i64 = $data['sum'];
		$i65 = $data['balance_open'];
		$i66 = $data['balance_close'];
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO balances (
			auth_id,
			auth_name,
			`timestamp`,
			organization_name,
			store_name,
			store_address,    
			store_kass,  
			num_fiskal,      
			num_factory,
			num_id,  
			num_tax,
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
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19', '$i20', '$i21', '$i22', '$i23', '$i24', '$i25', '$i26', '$i27', '$i28', '$i29', '$i30', '$i31', '$i32', '$i33', '$i34', '$i35', '$i36', '$i37', '$i38', '$i39', '$i40', '$i41', '$i42', '$i43', '$i44', '$i45', '$i46', '$i47', '$i48', '$i49', '$i50', '$i51', '$i52', '$i53', '$i54', '$i55', '$i56', '$i57', '$i58', '$i59', '$i60', '$i61', '$i62', '$i63', '$i64', '$i65', '$i66')";
		return mysqli_query($connection, $request);
	}

	public function get_branch_registration ($data) {
		$i0 = $data['z_id'];
		$i1 = $data['auth_id'];
		$i2 = $data['auth_name'];
		$i3 = $data['timestamp'];
		$i4 = $data['organization_name'];
		$i5 = $data['store_name'];
		$i6 = $data['store_address'];
		$i7 = $data['store_kass'];
		$i8 = $data['num_fiskal'];
		$i9 = $data['num_factory'];
		$i10 = $data['num_id'];
		$i11 = $data['num_tax'];
		$i12 = $data['type'];
		$i13 = $data['sum'];
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO branches (
			z_id,
			auth_id,
			auth_name,
			`timestamp`,
			organization_name,
			store_name,
			store_address,    
			store_kass,  
			num_fiskal,      
			num_factory,
			num_id,  
			num_tax,
			`type`,
			`sum`) VALUES
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13')";
		return mysqli_query($connection, $request);
	}
}