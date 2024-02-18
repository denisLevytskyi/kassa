<?php
namespace Models;
use Logics;

class PriceModel {
	public function get_price ($search_p, $search_v) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT price FROM app_prices WHERE $search_p= '$search_v' ORDER BY id DESC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		if ( ($record = mysqli_fetch_assoc($result)) ) {
			return ($record['price'] / 100);
		} else {
			return 0;
		}
	}

	public function get_all_prices ($order_asc = FALSE) {
		$prices = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM app_prices ORDER BY id" . ($order_asc ? ' ASC' : ' DESC');
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$record['price'] = $record['price'] / 100;
			$record['time'] = date("d-m-Y H:i:s", $record['timestamp']);
			$prices[] = $record;
		}
		return $prices;
	}

	public function get_price_registration ($art, $price, $time, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO app_prices (article, price, timestamp, auth_id) VALUES ('$art', '$price', '$time', '$id')";
		return mysqli_query($connection, $request);
	}
}