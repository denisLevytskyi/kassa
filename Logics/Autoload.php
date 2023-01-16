<?php 
function autoload ($name) {
	$pre_link = $_SERVER['DOCUMENT_ROOT'] . '/' .  $name . ".php";
	$link = str_replace("\\", "/", $pre_link);
	require_once $link;
}
spl_autoload_register('autoload');