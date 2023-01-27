<?php
namespace Models;
use Logics;

class KsefModel {
	public function get_document_registration ($name) {
		if (!is_file($name)) {
			$content = ob_get_contents();
			file_put_contents($name, $content);
			file_put_contents('Ksef/===CONTROL_TAPE===.html', $content, FILE_APPEND);
		}
	}

	public function get_all_documents () {
		$list = scandir($_SERVER['DOCUMENT_ROOT'] . '/Ksef', 1);
		$documents = array();
		foreach ($list as $k => $v) {
			if (preg_match('/\.(html)/', $v)) {
				$documents[] = $v;
			}
		}
		return $documents;
	}
}