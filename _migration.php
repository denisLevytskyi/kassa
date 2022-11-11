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

$i1 = 0;
$i2 = 0;
while ($i1 < 100) {
	$rand = rand(1, 1000000);
	$login = 'faker' . $rand . '@user.test';
	$password = rand(1000000, 9999999);
	$name = 'FAKER_' . $rand;
	$role = 1;
	$request = "INSERT INTO users (login, password, name, role) VALUES ('$login', '$password', '$name', '$role')";
	mysqli_query($connection, $request);
	echo ('<br><br>' . $login . ', ' . $password . ', ' . $name . ', ' . $role . '<br>');
	$i1++;
}
while ($i2 < 300) {
	$rand = rand(1, 10000000);
	$art = $rand;
	$code = '43000' . $rand;
	$name = "FAKER PROD [$rand]";
	$desk = "FAKER DESCRIPTION FOR FAKER PRODUCT $rand";
	$foto = '/Materials/no_foto.png';
	$id = 0;
	$request = "INSERT INTO products (article, code, name, description, foto, auth_id) VALUES ('$art', '$code', '$name', '$desk', '$foto', '$id')";
	mysqli_query($connection, $request);
	echo ('<br><br>' . $art . ', ' . $code . ', ' . $name . ', ' . $desk . '<br>');
	$i2++;
}