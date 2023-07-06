<?php
namespace Models;
use Logics;

class MoonModel {
	public function get_request ($host, $data) {
		if (!isset($_SESSION['moon'])) {
			session_start();
			$_SESSION['moon'] = array(
				'request' => array(),
				'answer' => array()
			);
		}
		$opts = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded',
				'timeout' => 600,
				'ignore_errors' => TRUE,
				'content' => http_build_query($data)
			)
		);
		$context = stream_context_create($opts);
		$answer = file_get_contents($host . '/terminal.php', false, $context);
		$_SESSION['moon']['request'][] = array(
			'time' => date("d-m-Y H:i:s", time()),
			'host' => $host,
			'data' => $data
		);
		$_SESSION['moon']['answer'][] = array(
			'time' => date("d-m-Y H:i:s", time()),
			'host' => $host,
			'data' => $answer
		);
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