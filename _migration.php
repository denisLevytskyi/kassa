<?php 
include 'Logic/Autoload.php';

$f_connection = Logic\Connection::get_first_connection();
$bd = Logic\Connection::bd;
$request0 = "CREATE DATABASE `$bd`";
$rezult0 = mysqli_query($f_connection, $request0);

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
echo "===== DATA BAZE ===============================<br>";
var_dump($rezult0);
echo "<br><br>===== USERS TABLE =============================<br>";
var_dump($rezult1);
echo "<br><br>===== PRODUCTS TABLE ==========================<br>";
var_dump($rezult2);

