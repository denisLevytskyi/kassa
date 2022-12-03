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
	`group` VARCHAR(100) DEFAULT NULL,
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
	`z_id` INT DEFAULT NULL,
	`auth_id` INT DEFAULT NULL,
	`auth_name` VARCHAR(50) DEFAULT NULL,
	`timestamp` VARCHAR(100) DEFAULT NULL,
	`type` VARCHAR(50) DEFAULT NULL,
	`body` VARCHAR(9000) DEFAULT NULL,
	`received_cash` VARCHAR(50) DEFAULT NULL,
	`received_card` VARCHAR(50) DEFAULT NULL,
	`change` VARCHAR(50) DEFAULT NULL,
	`summ` VARCHAR(50) DEFAULT NULL,
	`summ_a` VARCHAR(50) DEFAULT NULL,
	`summ_b` VARCHAR(50) DEFAULT NULL,
	`summ_v` VARCHAR(50) DEFAULT NULL,
	`summ_g` VARCHAR(50) DEFAULT NULL,
	`summ_m` VARCHAR(50) DEFAULT NULL,
	`summ_tax_a` VARCHAR(50) DEFAULT NULL,
	`summ_tax_b` VARCHAR(50) DEFAULT NULL,
	`summ_tax_v` VARCHAR(50) DEFAULT NULL,
	`summ_tax_g` VARCHAR(50) DEFAULT NULL,
	`summ_tax_m` VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);";
$request5 = "CREATE TABLE `branches` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`z_id` INT DEFAULT NULL,
	`auth_id` INT DEFAULT NULL,
	`auth_name` VARCHAR(50) DEFAULT NULL,
	`timestamp` VARCHAR(50) DEFAULT NULL,
	`type` VARCHAR(50) DEFAULT NULL,	
	`summ` VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);";
$request6 = "CREATE TABLE `balances` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`auth_id` INT DEFAULT NULL,
	`auth_name` VARCHAR(50) DEFAULT NULL,
	`timestamp` VARCHAR(50) DEFAULT NULL,
	`staff_in` VARCHAR(50) DEFAULT NULL,
	`staff_out` VARCHAR(50) DEFAULT NULL,
	`null_id_first` VARCHAR(50) DEFAULT NULL,
	`null_id_last` VARCHAR(50) DEFAULT NULL,
	`null_timestamp_first` VARCHAR(50) DEFAULT NULL,
	`null_timestamp_last` VARCHAR(50) DEFAULT NULL,
	`null_checks` VARCHAR(50) DEFAULT NULL,
	`sale_id_first` VARCHAR(50) DEFAULT NULL,
	`sale_id_last` VARCHAR(50) DEFAULT NULL,
	`sale_timestamp_first` VARCHAR(50) DEFAULT NULL,
	`sale_timestamp_last` VARCHAR(50) DEFAULT NULL,
	`sale_checks` VARCHAR(50) DEFAULT NULL,
	`sale_received_cash` VARCHAR(50) DEFAULT NULL,
	`sale_received_card` VARCHAR(50) DEFAULT NULL,
	`sale_change` VARCHAR(50) DEFAULT NULL,
	`sale_summ_cash` VARCHAR(50) DEFAULT NULL,
	`sale_summ_card` VARCHAR(50) DEFAULT NULL,
	`sale_summ` VARCHAR(50) DEFAULT NULL,
	`sale_summ_a` VARCHAR(50) DEFAULT NULL,
	`sale_summ_b` VARCHAR(50) DEFAULT NULL,
	`sale_summ_v` VARCHAR(50) DEFAULT NULL,
	`sale_summ_g` VARCHAR(50) DEFAULT NULL,
	`sale_summ_m` VARCHAR(50) DEFAULT NULL,
	`sale_summ_tax_a` VARCHAR(50) DEFAULT NULL,
	`sale_summ_tax_b` VARCHAR(50) DEFAULT NULL,
	`sale_summ_tax_v` VARCHAR(50) DEFAULT NULL,
	`sale_summ_tax_g` VARCHAR(50) DEFAULT NULL,
	`sale_summ_tax_m` VARCHAR(50) DEFAULT NULL,
	`sale_summ_tax` VARCHAR(50) DEFAULT NULL,
	`return_id_first` VARCHAR(50) DEFAULT NULL,
	`return_id_last` VARCHAR(50) DEFAULT NULL,
	`return_timestamp_first` VARCHAR(50) DEFAULT NULL,
	`return_timestamp_last` VARCHAR(50) DEFAULT NULL,
	`return_checks` VARCHAR(50) DEFAULT NULL,
	`return_received_cash` VARCHAR(50) DEFAULT NULL,
	`return_received_card` VARCHAR(50) DEFAULT NULL,
	`return_change` VARCHAR(50) DEFAULT NULL,
	`return_summ_cash` VARCHAR(50) DEFAULT NULL,
	`return_summ_card` VARCHAR(50) DEFAULT NULL,
	`return_summ` VARCHAR(50) DEFAULT NULL,
	`return_summ_a` VARCHAR(50) DEFAULT NULL,
	`return_summ_b` VARCHAR(50) DEFAULT NULL,
	`return_summ_v` VARCHAR(50) DEFAULT NULL,
	`return_summ_g` VARCHAR(50) DEFAULT NULL,
	`return_summ_m` VARCHAR(50) DEFAULT NULL,
	`return_summ_tax_a` VARCHAR(50) DEFAULT NULL,
	`return_summ_tax_b` VARCHAR(50) DEFAULT NULL,
	`return_summ_tax_v` VARCHAR(50) DEFAULT NULL,
	`return_summ_tax_g` VARCHAR(50) DEFAULT NULL,
	`return_summ_tax_m` VARCHAR(50) DEFAULT NULL,
	`return_summ_tax` VARCHAR(50) DEFAULT NULL,
	`summ_cash` VARCHAR(50) DEFAULT NULL,
	`summ_card` VARCHAR(50) DEFAULT NULL,
	`summ` VARCHAR(50) DEFAULT NULL,
	`balance_open` VARCHAR(50) DEFAULT NULL,
	`balance_close` VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (`id`)
);";
$rezult1 = mysqli_query($connection, $request1);
$rezult2 = mysqli_query($connection, $request2);
$rezult3 = mysqli_query($connection, $request3);
$rezult4 = mysqli_query($connection, $request4);
$rezult5 = mysqli_query($connection, $request5);
$rezult6 = mysqli_query($connection, $request6);

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
echo "<br><br>===== BRANCHES TABLE ==========================<br>";
var_dump($rezult5);
echo "<br><br>===== Z-BALANCE TABLE =========================<br>";
var_dump($rezult6);

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
