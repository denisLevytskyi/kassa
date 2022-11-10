<?php 
include 'Logic/Autoload.php';

$connection = Logic\Connection::get_connection();
$request1 = "CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(50) DEFAULT NULL,
	`password` VARCHAR(50) DEFAULT NULL,
	`name` VARCHAR(50) DEFAULT NULL,
	`role` VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
)";

$request2 = "CREATE TABLE `products` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`article` VARCHAR(100) DEFAULT NULL,
	`code` VARCHAR(100) DEFAULT NULL,
	`name` VARCHAR(100) DEFAULT NULL,
	`description` VARCHAR(100) DEFAULT NULL,
	`foto` VARCHAR(300) DEFAULT NULL,
	`auth_id` INT DEFAULT NULL,
	PRIMARY KEY (`id`)
)";

$rezult1 = mysqli_query($connection, $request1);
$rezult2 = mysqli_query($connection, $request2);
echo "<pre>";
echo "===== USERS TABLE ============================= <br><br>";
var_dump($rezult1);
var_dump($rezult2);
echo "<br>===== PRODUCTS TABLE ==========================";