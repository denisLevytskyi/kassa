<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(3);
$unika = new Controllers\UnikaController();
$unika->get_unika();