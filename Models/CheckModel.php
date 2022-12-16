<?php
namespace Models;
use Logics;

class CheckModel {
	public function get_check ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM checks WHERE $search_p= '$search_v'";
		$rezult = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($rezult)) ) {
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
			$checks[] = $record;
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
		$i9 = $data['summ'];
		$i10 = $data['summ_a'];
		$i11 = $data['summ_b'];
		$i12 = $data['summ_v'];
		$i13 = $data['summ_g'];
		$i14 = $data['summ_m'];
		$i15 = $data['summ_tax_a'];
		$i16 = $data['summ_tax_b'];
		$i17 = $data['summ_tax_v'];
		$i18 = $data['summ_tax_g'];
		$i19 = $data['summ_tax_m'];
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
			summ,
			summ_a,
			summ_b,
			summ_v,
			summ_g,
			summ_m,
			summ_tax_a,
			summ_tax_b,
			summ_tax_v,
			summ_tax_g,
			summ_tax_m
			)
			VALUES
			('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$i9', '$i10', '$i11', '$i12', '$i13', '$i14', '$i15', '$i16', '$i17', '$i18', '$i19')";
		return mysqli_query($connection, $request);
	}
}