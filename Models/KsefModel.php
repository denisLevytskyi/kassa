<?php
namespace Models;
use Logics;

class KsefModel {
	public function get_document_registrarion ($name) {
		if (!is_file($name)) {
			$content = ob_get_contents();
			file_put_contents($name, $content);
		}
	}

	public function get_all_documents () {
		$list = scandir($_SERVER['DOCUMENT_ROOT'] . '/Ksef');
		$documents = array();
		foreach ($list as $k => $v) {
			if (preg_match('/\.(html)/', $v)) {
				array_push($documents, $v);
			}
		}
		return $documents;
	}
}