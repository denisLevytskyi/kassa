<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(2);
$price_setter = new Controllers\PriceSetterController();
$price_setter->get_price_setter();