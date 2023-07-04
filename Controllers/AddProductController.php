<?php
namespace Controllers;
use Views;
use Models;

class AddProductController {
	protected function view_add_product () {
		$view = new Views\View();
		$view->view_template('addProduct');
	}

	protected function set_move_photo ($file) {
		$new_name_short = "/Materials/" . time() . $file['name'];
		$new_name = $_SERVER['DOCUMENT_ROOT'] . $new_name_short;
		move_uploaded_file($file['tmp_name'], $new_name);
		return 'http://' . $_SERVER['HTTP_HOST'] . $new_name_short;
	}

	protected function set_product_registration () {
		$group = $_POST['add_product_group'];
		$art = $_POST['add_product_art'];
		$code = $_POST['add_product_code'];
		$name = $_POST['add_product_name'];
		$desk = $_POST['add_product_description'];
		$photo = '/Materials/no_photo.png';
		$id = $_SESSION['auth']['id'];
		$model = new Models\ProductModel();
		if ( (is_uploaded_file($_FILES['add_product_photo']['tmp_name'])) ) {
			$file = $_FILES['add_product_photo'];
			$photo = $this->set_move_photo($file);
		}
		if ( ($model->get_product_registration($group, $art, $code, $name, $desk, $photo, $id)) ) {
			header('Location: /');
		} else {
			ErrorController::get_view_error(11);
		}
	}

	public function get_add_product_check () {
		if (isset($_POST['add_product_art'])) {
			$this->set_product_registration();
		} else {
			$this->view_add_product();
		}
	}
}