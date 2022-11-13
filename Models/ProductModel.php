<?php
namespace Models;
use Logics;

class ProductModel {
	public function get_all_products () {
		$products = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, article, name, foto FROM products ORDER BY article ASC";
		$rezult = mysqli_query($connection, $request);
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			array_push($products, $record);
		}
		return $products;
	}

	public function get_product ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM products WHERE $search_p= '$search_v'";
		$rezult = mysqli_query($connection, $request);
		$record = mysqli_fetch_assoc($rezult);
		return $record;
	}

	public function get_chenges($id, $art, $code, $name, $desk) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE products SET article = '$art', code = '$code', name = '$name', description = '$desk' WHERE id = '$id'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}

	public function get_product_registration ($art, $code, $name, $desk, $foto, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO products (article, code, name, description, foto, auth_id) VALUES ('$art', '$code', '$name', '$desk', '$foto', '$id')";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}

	public function get_delete ($id) {
		$connection = Logics\Connection::get_connection();
		$request = "DELETE FROM products WHERE id = '$id'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}