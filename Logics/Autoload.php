<?php 
function autoload ($name) {
	$prelink = $_SERVER['DOCUMENT_ROOT'] . '/' .  $name . ".php";
	$link = str_replace("\\", "/", $prelink);
	require_once $link;
}
spl_autoload_register('autoload');