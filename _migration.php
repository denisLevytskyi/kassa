<?php 
include 'Logics/Autoload.php';

$f_connection = Logics\Connection::get_first_connection();
$bd = Logics\Connection::bd;
$request0 = "CREATE DATABASE `$bd`";
$rezult0 = mysqli_query($f_connection, $request0);

$connection = Logics\Connection::get_connection();
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
$request3 = "CREATE TABLE `prices` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`article` VARCHAR(100) DEFAULT NULL,
	`price` INT(100) DEFAULT NULL,
	`timestamp` VARCHAR(100),
	`auth_id` INT DEFAULT NULL,
	PRIMARY KEY (`id`)
);";
$request4 = "CREATE TABLE `checks` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`auth_id` INT DEFAULT NULL,
	`auth_name` VARCHAR(50) DEFAULT NULL,
	`timestamp` VARCHAR(100) DEFAULT NULL,
	`summ` VARCHAR(50) DEFAULT NULL,
	`body` VARCHAR(9000) DEFAULT NULL,
	`received_cash` VARCHAR(50) DEFAULT NULL,
	`received_card` VARCHAR(50) DEFAULT NULL,
	`change` VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);";
$rezult1 = mysqli_query($connection, $request1);
$rezult2 = mysqli_query($connection, $request2);
$rezult3 = mysqli_query($connection, $request3);
$rezult4 = mysqli_query($connection, $request4);

echo "<pre>";
echo "===== DATA BASE ===============================<br>";
var_dump($rezult0);
echo "<br><br>===== USERS TABLE =============================<br>";
var_dump($rezult1);
echo "<br><br>===== PRODUCTS TABLE ==========================<br>";
var_dump($rezult2);
echo "<br><br>===== PRICES TABLE ============================<br>";
var_dump($rezult3);
echo "<br><br>===== CHECKS TABLE ============================<br>";
var_dump($rezult4);

$i1 = 1000;
$i2 = 1000;
echo "<br><br>===== USERS FABRIC ============================<br>";
while ($i1 < 100) {
	$rand = rand(1, 1000000);
	$login = 'faker' . $rand . '@user.test';
	$password = rand(1000000, 9999999);
	$name = 'FAKER_' . $rand;
	$role = 1;
	$request = "INSERT INTO users (login, password, name, role) VALUES ('$login', '$password', '$name', '$role')";
	mysqli_query($connection, $request);
	echo ($login . ', ' . $password . ', ' . $name . ', ' . $role . '<br>');
	$i1++;
}
echo "<br><br>===== PRODUCTS FABRIC =========================<br>";
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
	echo ($art . ', ' . $code . ', ' . $name . ', ' . $desk . '<br>');
	$i2++;
}