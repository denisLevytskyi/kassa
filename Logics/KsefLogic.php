<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(4);
$ksef = new Controllers\KsefController();
$ksef->get_ksef();