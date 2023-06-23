<?php
namespace Models;
use Logics;

class BaseModel {
	public function get_request ($host, $data) {
		$request_data = http_build_query($data);
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $request_data
			)
		);
		$context = stream_context_create($opts);
		return file_get_contents($host . '/terminal.php', false, $context);
	}

	public function get_factor_update ($table, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE $table SET base_factor = 1 WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}

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
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO basechecks (
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

}