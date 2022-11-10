<?php
namespace Models;
use Logic;

class ProductModel {
	public function get_all_products () {
		$products = array();
		$connection = Logic\Connection::get_connection();
		$request = "SELECT id, article, name, foto FROM products";
		if ( ($rezult = mysqli_query($connection, $request)) ) {
			while ( ($record = mysqli_fetch_assoc($rezult)) ) {
				array_push($products, $record);
			}
			return $products;
		}
	}

	public function get_product_registration ($art, $code, $name, $desk, $foto, $id) {
		$connection = Logic\Connection::get_connection();
		$request = "INSERT INTO products (article, code, name, description, foto, auth_id) VALUES ('$art', '$code', '$name', '$desk', '$foto', '$id')";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}