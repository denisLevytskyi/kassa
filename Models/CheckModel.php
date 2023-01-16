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
		$i4 = $data['type'];
		$i5 = $data['body'];
		$i6 = $data['received_cash'];
		$i7 = $data['received_card'];
		$i8 = $data['change'];
		$i9 = $data['sum'];
		$i10 = $data['sum_a'];
		$i11 = $data['sum_b'];
		$i12 = $data['sum_v'];
		$i13 = $data['sum_g'];
		$i14 = $data['sum_m'];
		$i15 = $data['sum_tax_a'];
		$i16 = $data['sum_tax_b'];
		$i17 = $data['sum_tax_v'];
		$i18 = $data['sum_tax_g'];
		$i19 = $data['sum_tax_m'];
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
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19')";
		return mysqli_query($connection, $request);
	}
}