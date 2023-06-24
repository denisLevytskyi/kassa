<?php
namespace Models;
use Logics;

class BaseModel {
	public function get_base_check_registration ($data) {
		$id = $data['id'];
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
		$i13 = $data['body'];
		$i14 = $data['received_cash'];
		$i15 = $data['received_card'];
		$i16 = $data['change'];
		$i17 = $data['sum_cash'];
		$i18 = $data['sum_card'];
		$i19 = $data['sum'];
		$i20 = $data['sum_a'];
		$i21 = $data['sum_b'];
		$i22 = $data['sum_v'];
		$i23 = $data['sum_g'];
		$i24 = $data['sum_m'];
		$i25 = $data['sum_tax_a'];
		$i26 = $data['sum_tax_b'];
		$i27 = $data['sum_tax_v'];
		$i28 = $data['sum_tax_g'];
		$i29 = $data['sum_tax_m'];
		$connection = Logics\Connection::get_base_connection();
		$request = "INSERT INTO base_checks (
			i_id,
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
			type,
			`body`,
			received_cash,
			received_card,
			`change`,
			sum_cash,
			sum_card,
			sum,
			sum_a,
			sum_b,
			sum_v,
			sum_g,
			sum_m,
			sum_tax_a,
			sum_tax_b,
			sum_tax_v,
			sum_tax_g,
			sum_tax_m
			)
			VALUES
			('$id', '$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19', '$i20', '$i21', '$i22', '$i23', '$i24', '$i25', '$i26', '$i27', '$i28', '$i29')";
		return mysqli_query($connection, $request);
	}

	public function get_all_base_checks () {
		$checks = array();
		$connection = Logics\Connection::get_base_connection();
		$request = "SELECT id, i_id, z_id, auth_id, auth_name, `timestamp`, store_kass, type, sum FROM base_checks ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("d-m-Y H:i:s", $record['timestamp']);
			$checks[] = $record;
		}
		return $checks;
	}

	public function get_base_branch_registration ($data) {
		$id = $data['id'];
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
		$connection = Logics\Connection::get_base_connection();
		$request = "INSERT INTO base_branches (
			i_id,
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
			`sum`
			)
			VALUES
			('$id', '$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13')";
		return mysqli_query($connection, $request);
	}

	public function get_all_base_branches () {
		$branches = array();
		$connection = Logics\Connection::get_base_connection();
		$request = "SELECT id, i_id, z_id, auth_id, auth_name, `timestamp`, store_kass, `type`, `sum` FROM base_branches ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("d-m-Y H:i:s", $record['timestamp']);
			$branches[] = $record;
		}
		return $branches;
	}

	public function get_base_balance_registration ($data) {
		$id = $data['id'];
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
		$i29 = $data['sale_round_plus'];
		$i30 = $data['sale_round_minus'];
		$i31 = $data['sale_sum_a'];
		$i32 = $data['sale_sum_b'];
		$i33 = $data['sale_sum_v'];
		$i34 = $data['sale_sum_g'];
		$i35 = $data['sale_sum_m'];
		$i36 = $data['sale_sum_tax_a'];
		$i37 = $data['sale_sum_tax_b'];
		$i38 = $data['sale_sum_tax_v'];
		$i39 = $data['sale_sum_tax_g'];
		$i40 = $data['sale_sum_tax_m'];
		$i41 = $data['sale_sum_tax'];
		$i42 = $data['return_id_first'];
		$i43 = $data['return_id_last'];
		$i44 = $data['return_timestamp_first'];
		$i45 = $data['return_timestamp_last'];
		$i46 = $data['return_checks'];
		$i47 = $data['return_received_cash'];
		$i48 = $data['return_received_card'];
		$i49 = $data['return_change'];
		$i50 = $data['return_sum_cash'];
		$i51 = $data['return_sum_card'];
		$i52 = $data['return_sum'];
		$i53 = $data['return_round_plus'];
		$i54 = $data['return_round_minus'];
		$i55 = $data['return_sum_a'];
		$i56 = $data['return_sum_b'];
		$i57 = $data['return_sum_v'];
		$i58 = $data['return_sum_g'];
		$i59 = $data['return_sum_m'];
		$i60 = $data['return_sum_tax_a'];
		$i61 = $data['return_sum_tax_b'];
		$i62 = $data['return_sum_tax_v'];
		$i63 = $data['return_sum_tax_g'];
		$i64 = $data['return_sum_tax_m'];
		$i65 = $data['return_sum_tax'];
		$i66 = $data['sum_cash'];
		$i67 = $data['sum_card'];
		$i68 = $data['sum'];
		$i69 = $data['balance_open'];
		$i70 = $data['balance_close'];
		$connection = Logics\Connection::get_base_connection();
		$request = "INSERT INTO base_balances (
			i_id,
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
			sale_round_plus,
			sale_round_minus,
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
			return_round_plus,
			return_round_minus,
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
			balance_close
			)
			VALUES
			('$id', '$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19', '$i20', '$i21', '$i22', '$i23', '$i24', '$i25', '$i26', '$i27', '$i28', '$i29', '$i30', '$i31', '$i32', '$i33', '$i34', '$i35', '$i36', '$i37', '$i38', '$i39', '$i40', '$i41', '$i42', '$i43', '$i44', '$i45', '$i46', '$i47', '$i48', '$i49', '$i50', '$i51', '$i52', '$i53', '$i54', '$i55', '$i56', '$i57', '$i58', '$i59', '$i60', '$i61', '$i62', '$i63', '$i64', '$i65', '$i66', '$i67', '$i68', '$i69', '$i70')";
		return mysqli_query($connection, $request);
	}
}