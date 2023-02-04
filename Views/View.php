<?php
namespace Views;

class View {
	public function view_template ($template) {
		require_once "Templates/" . $template . ".php";
	}
}