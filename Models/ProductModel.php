<?php
namespace Models;
use Logics;

class ProductModel extends PriceModel {
	public function get_product ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = $search_p == 'name' ? "SELECT * FROM products WHERE name LIKE '%$search_v%'" : "SELECT * FROM products WHERE $search_p= '$search_v'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['price'] = $this->get_price('article', $record['article']);
			return $record;
		}
	}

	public function get_all_products ($all = FALSE) {
		$products = array();
		$connection = Logics\Connection::get_connection();
		$request = $all ? "SELECT * FROM products" : "SELECT id, article, name, photo FROM products ORDER BY article";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$products[] = $record;
		}
		return $products;
	}

	public function get_product_registration ($group, $art, $code, $name, $desk, $photo, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO products (`group`, article, code, name, description, photo, auth_id) VALUES ('$group', '$art', '$code', '$name', '$desk', '$photo', '$id')";
		return mysqli_query($connection, $request);
	}

	public function get_changes($id, $group, $art, $code, $name, $desk, $photo) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE products SET `group` = '$group', article = '$art', code = '$code', name = '$name', description = '$desk', photo = '$photo' WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}

	public function get_delete ($id) {
		$connection = Logics\Connection::get_connection();
		$request = "DELETE FROM products WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}
}