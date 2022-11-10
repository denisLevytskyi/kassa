<?php
namespace Models;
use Logic;

class AuthModel {
	protected function get_user_id_by_password ($rezult, $password) {
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			if ($record['password'] == $password) {
				return $record['id'];
				exit;
			}
		}
	}

	protected function get_user_name_by_id ($rezult, $id) {
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			if ($record['id'] == $id) {
				return $record['name'];
				exit;
			}
		}
	}

	protected function get_user_login_by_id ($rezult, $id) {
		while ( ($record = mysqli_fetch_assoc($rezult)) ) {
			if ($record['id'] == $id) {
				return $record['login'];
				exit;
			}
		}
	}

	public function get_login_by_id ($id) {
		$connection = Logic\Connection::get_connection();
		$request = "SELECT * FROM users WHERE id='$id'";
		$rezult = mysqli_query($connection, $request);
		return $this->get_user_login_by_id($rezult, $id);
	}

	public function get_name_by_id ($id) {
		$connection = Logic\Connection::get_connection();
		$request = "SELECT * FROM users WHERE id='$id'";
		$rezult = mysqli_query($connection, $request);
		return $this->get_user_name_by_id($rezult, $id);
	}

	public function get_user_check ($login, $password) {
		$connection = Logic\Connection::get_connection();
		$request = "SELECT * FROM users WHERE login='$login'";
		$rezult = mysqli_query($connection, $request);
		return $this->get_user_id_by_password($rezult, $password);
	}

	public function get_user_sing ($login, $password, $name, $role = '1') {
		$connection = Logic\Connection::get_connection();
		$request = "INSERT INTO users (login, password, name, role) VALUES ('$login', '$password', '$name', '$role')";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			$request = "SELECT * FROM users WHERE login='$login'";
			$rezult = mysqli_query($connection, $request);
			return $this->get_user_id_by_password($rezult, $password);
		}
	}

	public function get_chenges ($id, $login, $password, $name) {
		$connection = Logic\Connection::get_connection();
		$request = "UPDATE users SET login = '$login', password = '$password', name = '$name' WHERE id = '$id'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}

	public function get_delete ($id) {
		$connection = Logic\Connection::get_connection();
		$request = "DELETE FROM users WHERE id = '$id'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}

	public function get_reset ($login, $password) {
		$connection = Logic\Connection::get_connection();
		$request = "UPDATE users SET password = '$password' WHERE login = '$login'";
		$rezult = mysqli_query($connection, $request);
		if ( $rezult == 1 ) {
			return true;
		}
	}
}