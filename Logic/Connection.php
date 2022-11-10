<?php
namespace Logic;

class Connection {
	const host = 'localhost';
	const user = 'root';
	const password = '';
	const bd = 'test';

	public static function get_connection () {
		$connection = mysqli_connect(
			self::host,
			self::user,
			self::password,
			self::bd
		);
		return $connection;
	}
}