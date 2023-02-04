<?php
namespace Controllers;
use Views;
use Models;

class KsefController {
	protected function view_ksef () {
		$view = new Views\View();
		$view->view_template('ksef');
	}

	protected function set_ksef_list () {
		$model = new Models\KsefModel();
		if ( ($documents = $model->get_all_documents()) ) {
			$_SESSION['ksef'] = $documents;
		} else {
			ErrorController::get_view_error(30);
		}
	}

	public function get_ksef () {
		$this->set_ksef_list();
		$this->view_ksef();
	}
}