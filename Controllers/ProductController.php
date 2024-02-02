<?php
namespace Controllers;
use Views;
use Models;

class ProductController {
	protected function view_product () {
		$view = new Views\View();
		$view->view_template('product');
	}

	protected function set_product_by_code () {
		$model = new Models\ProductModel();
		$code = $_GET['product_code'];
		$search_p = 'code';
		if ($code[0] == '*') {
			$search_p = 'article';
			$code = trim($code, '*');
		}
		if ( ($product = $model->get_product($search_p, $code)) ) {
			session_start();
			$_SESSION['product'] = $product;
		} else {
			ErrorController::get_view_error(18);
		}
	}

	protected function set_product_by_id () {
		$model = new Models\ProductModel();
		$id = $_GET['product_id'];
		if ( ($product = $model->get_product('id', $id)) ) {
			session_start();
			$_SESSION['product'] = $product;
		} else {
			ErrorController::get_view_error(18);
		}
	}

	protected function set_move_photo ($file) {
		$new_name_short = "/Materials/" . time() . $file['name'];
		$new_name = $_SERVER['DOCUMENT_ROOT'] . $new_name_short;
		move_uploaded_file($file['tmp_name'], $new_name);
		return 'http://' . $_SERVER['HTTP_HOST'] . $new_name_short;
	}

	protected function set_changes_product () {
		$id = $_POST['edit_product_id'];
		$group = $_POST['edit_product_group'];
		$art = $_POST['edit_product_art'];
		$code = $_POST['edit_product_code'];
		$name = $_POST['edit_product_name'];
		$desk = $_POST['edit_product_desc'];
		$photo = $_POST['edit_product_old_photo'];
		$model = new Models\ProductModel();
		if ( (is_uploaded_file($_FILES['edit_product_photo']['tmp_name'])) ) {
			$file = $_FILES['edit_product_photo'];
			$photo = $this->set_move_photo($file);
		}
		if ( ($model->get_changes($group, $id, $art, $code, $name, $desk, $photo)) ) {
			header('Location: /productList.php');
		} else {
			ErrorController::get_view_error(16);
		}
	}

	protected function set_delete () {
		$model = new Models\ProductModel();
		$id = $_SESSION['product']['id'];
		if ( ($model->get_delete($id)) ) {
			header('Location: /productList.php');
		} else {
			ErrorController::get_view_error(17);
		}
	}

	public function get_product () {
		if (isset($_GET['product_delete'])) {
			$this->set_delete();
		} elseif (isset($_POST['edit_product_id'])) {
			$this->set_changes_product();
		} elseif (isset($_GET['product_id'])) {
			$this->set_product_by_id();
			$this->view_product();
		} elseif (isset($_GET['product_code'])) {
			$this->set_product_by_code();
			$this->view_product();
		} else {
			ErrorController::get_view_error(14);
		}
	}
}