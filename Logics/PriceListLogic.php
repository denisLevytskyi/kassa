<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(2);
$price_list = new Controllers\PriceListController();
$price_list->get_price_list();