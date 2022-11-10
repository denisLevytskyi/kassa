<?php
namespace Controllers;
use Views;
use Models;

class AddProductController {
	protected function view_add_product () {
		$view = new Views\View();
		$view->view_add_product();
	}

	protected function set_move_foto ($file) {
		$new_name_short = "/Materials/" . time() . $file['name'];
		$new_name = $_SERVER['DOCUMENT_ROOT'] . $new_name_short;
		move_uploaded_file($file['tmp_name'], $new_name);
		return $new_name_short;
	}

	protected function set_product_registration () {
		$art = $_POST['add_product_art'];
		$code = $_POST['add_product_code'];
		$name = $_POST['add_product_name'];
		$desk = $_POST['add_product_description'];
		$foto = '/Materials/no_foto.png';
		$id = $_SESSION['auth_id'];
		$model = new Models\ProductModel();
		if ( (is_uploaded_file($_FILES['add_product_foto']['tmp_name'])) ) {
			$file = $_FILES['add_product_foto'];
			$foto = $this->set_move_foto($file);
		}
		if ( ($model->get_product_registration($art, $code, $name, $desk, $foto, $id)) ) {
			header('Location: /');
		} else {
			ErrorController::get_view_error(11);
		}
	}

	public function get_add_product_check () {
		if (isset($_POST['add_product_1'])) {
			$this->set_product_registration();
		} else {
			$this->view_add_product();
		}
	}
}