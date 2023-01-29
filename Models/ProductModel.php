<?php
namespace Models;
use Logics;

class ProductModel extends PriceModel {
	public function get_all_products () {
		$products = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT id, article, name, photo FROM products ORDER BY article";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$products[] = $record;
		}
		return $products;
	}

	public function get_product ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM products WHERE $search_p LIKE '%$search_v%'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
			$art = $record['article'];
			$price = $this->get_price($art);
			$record['price'] = $price;
			return $record;
		}
	}

	public function get_changes($id, $art, $code, $name, $desk, $photo) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE products SET article = '$art', code = '$code', name = '$name', description = '$desk', photo = '$photo' WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}

	public function get_product_registration ($group, $art, $code, $name, $desk, $photo, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO products (`group`, article, code, name, description, photo, auth_id) VALUES ('$group', '$art', '$code', '$name', '$desk', '$photo', '$id')";
		return mysqli_query($connection, $request);
	}

	public function get_delete ($id) {
		$connection = Logics\Connection::get_connection();
		$request = "DELETE FROM products WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}
}
