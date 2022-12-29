<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(2);
$add_product = new Controllers\AddProductController();
$add_product->get_add_product_check();