<?php
namespace Models;
use Logics;

class PriceModel {
	public function get_price ($art) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT price FROM prices WHERE article = '$art' ORDER BY id DESC";
		$rezult = mysqli_query($connection, $request);
		if ( ($record = mysqli_fetch_assoc($rezult)) ) {
			return ($record['price'] / 100);
		} else {
			return 0;
		}
	}

	public function get_price_registration ($art, $price, $time, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO prices (article, price, timestamp, auth_id) VALUES ('$art', '$price', '$time', '$id')";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}