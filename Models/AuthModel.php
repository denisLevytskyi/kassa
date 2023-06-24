<?php
namespace Models;
use Logics;

class AuthModel {
	public function get_user ($search_p, $search_v, $search_p2, $search_v2) {
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM users WHERE $search_p='$search_v' AND $search_p2='$search_v2'";
		$result = mysqli_query($connection, $request) or header('Location: /');
		return mysqli_fetch_assoc($result);
	}

	public function get_all_users () {
		$users = array();
		$connection = Logics\Connection::get_connection();
		$request = "SELECT * FROM users ORDER BY id ASC";
		$result = mysqli_query($connection, $request) or header('Location: /');
		while ( ($record = mysqli_fetch_assoc($result)) ) {
			$users[] = $record;
		}
		return $users;
	}

	public function get_user_sign ($login, $password, $name, $role = '1') {
		$connection = Logics\Connection::get_connection();
		$request = "INSERT INTO users (login, password, name, role) VALUES ('$login', '$password', '$name', '$role')";
		if (mysqli_query($connection, $request)) {
			return $this->get_user('login', $login, 'password', $password);
		}
	}

	public function get_changes ($id, $login, $password, $name, $role) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE users SET login = '$login', password = '$password', name = '$name', role = '$role' WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}

	public function get_delete ($id) {
		$connection = Logics\Connection::get_connection();
		$request = "DELETE FROM users WHERE id = '$id'";
		return mysqli_query($connection, $request);
	}

	public function get_reset ($login, $password) {
		$connection = Logics\Connection::get_connection();
		$request = "UPDATE users SET password = '$password' WHERE login = '$login'";
		return mysqli_query($connection, $request);
	}
}