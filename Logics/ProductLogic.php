<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(2);
$product = new Controllers\ProductController();
$product->get_product();