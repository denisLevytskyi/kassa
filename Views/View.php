<?php
namespace Views;

class View {
	public function view_login () {
		require_once "Templates/login.php";
	}

	public function view_main () {
		require_once "Templates/main.php";
	}

	public function view_error () {
		require_once "Templates/error.php";
	}

	public function view_sing1 () {
		require_once "Templates/sing1.php";
	}

	public function view_sing2 () {
		require_once "Templates/sing2.php";
	}

	public function view_edit_auth () {
		require_once "Templates/editAuth.php";
	}

	public function view_add_product () {
		require_once "Templates/addProduct.php";
	}

	public function view_product_list () {
		require_once "Templates/productList.php";
	}
}