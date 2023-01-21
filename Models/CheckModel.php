<?php
namespace Models;
use Logics;

class CheckModel {
	public function get_check ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM checks WHERE $search_p= '$search_v'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['main'] = unserialize($record['body']);
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			return $record;
		}
	}
	
	public function get_checks_by_z_id ($z_id) {
		$checks = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM checks WHERE z_id= '$z_id'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			$checks[] = $record;
		}
		return $checks;
	}

	public function get_all_checks () {
		$checks = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, z_id, auth_id, auth_name, `timestamp`, type, sum FROM checks ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['time'] = date("y-m-d H:i:s", $record['timestamp']);
			$checks[] = $record;
		}
		return $checks;
	}

	public function get_check_registration ($data) {
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
		$i17 = $data['sum'];
		$i18 = $data['sum_a'];
		$i19 = $data['sum_b'];
		$i20 = $data['sum_v'];
		$i21 = $data['sum_g'];
		$i22 = $data['sum_m'];
		$i23 = $data['sum_tax_a'];
		$i24 = $data['sum_tax_b'];
		$i25 = $data['sum_tax_v'];
		$i26 = $data['sum_tax_g'];
		$i27 = $data['sum_tax_m'];
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO checks (
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
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19', '$i20', '$i21', '$i22', '$i23', '$i24', '$i25', '$i26', '$i27')";
		return mysqli_query($connection, $request);
	}
}