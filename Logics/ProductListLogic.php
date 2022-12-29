<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(2);
$product_list = new Controllers\ProductListController();
$product_list->get_product_list();