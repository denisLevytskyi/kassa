<?php
namespace Models;
use Logics;

class ProductModel extends PriceModel {
	public function get_product ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = $search_p == 'name' ? "SELECT * FROM app_products WHERE name LIKE '%$search_v%'" : "SELECT * FROM app_products WHERE $search_p= '$search_v'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['price'] = $this->get_price('article', $record['article']);
			return $record;
		}
	}

	public function get_all_products ($all = FALSE) {
		$products = array();
		$connection = Logics\Connection::get_connection();
		$request = $all ? "SELECT * FROM app_products" : "SELECT id, article, name, photo FROM app_products ORDER BY article";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$products[] = $record;
		}
		return $products;
	}

	public function get_product_registration ($data) {
		$i0 = $data['group'];
		$i1 = $data['article'];
		$i2 = $data['code'];
		$i3 = $data['gov_code'];
		$i4 = $data['name'];
		$i5 = $data['description'];
		$i6 = $data['photo'];
		$i7 = $data['auth_id'];
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO app_products (
			`group`,
			 article,
			 code,
			 gov_code,
			 name,
			 `description`,
			 photo,
			 auth_id
			 )
			 VALUES
			 ('$i0', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7')";
		return mysqli_query($connection, $request);
	}

	public function get_changes($data) {
		$i0 = $data['id'];
		$i1 = $data['group'];
		$i2 = $data['article'];
		$i3 = $data['code'];
		$i4 = $data['gov_code'];
		$i5 = $data['name'];
		$i6 = $data['description'];
		$i7 = $data['photo'];
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE app_products SET `group` = '$i1', article = '$i2', code = '$i3', gov_code = '$i4', name = '$i5', description = '$i6', photo = '$i7' WHERE id = '$i0'";
		return mysqli_query($connection, $request);
	}

	public function get_delete ($id) {
		$connection = Logics\Connection::get_connection();
		$request = "DELETE FROM app_products WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}
}