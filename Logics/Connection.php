<?php
namespace Logics;

class Connection {
	const host = 'localhost';
	const user = 'root';
	const password = '';
	const bd = 'product_manager';

	public static function get_connection () {
		return mysqli_connect(
			self::host,
			self::user,
			self::password,
			self::bd
		);
	}

	public static function get_first_connection () {
		return mysqli_connect(
			self::host,
			self::user,
			self::password
		);
	}
}