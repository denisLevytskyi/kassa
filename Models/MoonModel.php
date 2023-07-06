<?php
namespace Models;
use Logics;

class MoonModel {
	public function get_request ($host, $data) {
		$request_data = http_build_query($data);
		$opts = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded',
				'content' => $request_data
			)
		);
		$context = stream_context_create($opts);
		if (!isset($_SESSION['moon'])) {
			session_start();
			$_SESSION['moon'] = array(
				'request' => array(),
				'answer' => array()
			);
		}
		$answer = file_get_contents($host . '/terminal.php', false, $context);
		$_SESSION['moon']['request'][] = $data;
		$_SESSION['moon']['answer'][] = $answer;
		return $answer;
	}

	public function get_factor_update ($table, $id) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE $table SET base_factor = 1 WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}

	public function get_factor_delete ($table) {
		$connection = Logics\Connection::get_connection();
		$bd = Logics\Connection::bd;
		$request = "UPDATE $table SET base_factor = 0";
		return mysqli_query($connection, $request);
	}

	public function get_truncate ($table, $base_factor = FALSE) {
		$connection = $base_factor ? Logics\Connection::get_first_base_connection() : Logics\Connection::get_first_connection();
		$bd = $base_factor ? Logics\Connection::base_bd : Logics\Connection::bd;
		$request = "TRUNCATE `$bd`.`$table`";
		return mysqli_query($connection, $request);
	}
}