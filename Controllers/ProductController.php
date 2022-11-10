<?php
namespace Controllers;
use Views;
use Models;

class ProductController {
	protected function view_product () {
		$view = new Views\View();
		$view->view_product();
	}

	protected function set_changes_product () {
		$id = $_SESSION['product']['id'];
		$art = $_POST['edit_product_art'];
		$code = $_POST['edit_product_code'];
		$name = $_POST['edit_product_name'];
		$desk = $_POST['edit_product_description'];
		$model = new Models\ProductModel();
		if ( ($model->get_chenges($id, $art, $code, $name, $desk)) ) {
			header('Location: /productList.php');
		} else {
			ErrorController::get_view_error(16);
		}
	}

	protected function set_product_by_id () {
		$model = new Models\ProductModel();
		$id = $_GET['product_id'];
		if ( ($product = $model->get_product_by_id($id)) ) {
			session_start();
			$_SESSION['product'] = $product;
		} else {
			ErrorController::get_view_error(12);
		}
	}

	protected function set_product_by_art () {
		$model = new Models\ProductModel();
		$art = $_GET['product_art'];
		if ( ($product = $model->get_product_by_art($art)) ) {
			session_start();
			$_SESSION['product'] = $product;
		} else {
			ErrorController::get_view_error(12);
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
		if (isset($_POST['product_1'])) {
			$this->set_changes_product();
		} elseif (isset($_GET['product_id'])) {
			$this->set_product_by_id();
			$this->view_product();
		} elseif (isset($_GET['product_art'])) {
			$this->set_product_by_art();
			$this->view_product();
		} else {
			ErrorController::get_view_error(14);
		}
		if (isset($_GET['delete'])) {
			$this->set_delete();
		}
	}
}