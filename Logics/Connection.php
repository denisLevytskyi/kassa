<?php
namespace Logics;

class Connection {
	const host = 'localhost';
	const user = 'root';
	const password = '';
	const bd = 'product_manager';

	const base_factor = TRUE;
	const base_list = array(
		'http://localhost'
	);

	const base_host = 'localhost';
	const base_user = 'root';
	const base_password = '';
	const base_bd = 'product_manager';

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

	public static function get_base_connection () {
		return mysqli_connect(
			self::base_host,
			self::base_user,
			self::base_password,
			self::base_bd
		);
	}

	public static function get_first_base_connection () {
		return mysqli_connect(
			self::base_host,
			self::base_user,
			self::base_password
		);
	}
}