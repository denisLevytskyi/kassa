<?php
namespace Logics;

class Connection {
	const host = 'localhost';
	const user = 'root';
	const password = '';
	const bd = 'product_meneger';

	public static function get_connection () {
		$connection = mysqli_connect(
			self::host,
			self::user,
			self::password,
			self::bd
		);
		return $connection;
	}

	public static function get_first_connection () {
		$connection = mysqli_connect(
			self::host,
			self::user,
			self::password
		);
		return $connection;
	}
}