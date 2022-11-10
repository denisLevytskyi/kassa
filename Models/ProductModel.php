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

	public function get_product_by_id ($id) {
		$connection = Logic\Connection::get_connection();
		$request = "SELECT * FROM products WHERE id = '$id'";
		if ( ($rezult = mysqli_query($connection, $request)) ) {
			while ( ($record = mysqli_fetch_assoc($rezult)) ) {
				return $record;
			}
		}
	}

	public function get_product_by_art ($art) {
		$connection = Logic\Connection::get_connection();
		$request = "SELECT * FROM products WHERE article = '$art'";
		if ( ($rezult = mysqli_query($connection, $request)) ) {
			while ( ($record = mysqli_fetch_assoc($rezult)) ) {
				return $record;
				die();
			}
		}
	}

	public function get_chenges($id, $art, $code, $name, $desk) {
		$connection = Logic\Connection::get_connection();
		$request = "UPDATE products SET article = '$art', code = '$code', name = '$name', description = '$desk' WHERE id = '$id'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
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

	public function get_delete ($id) {
		$connection = Logic\Connection::get_connection();
		$request = "DELETE FROM products WHERE id = '$id'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}