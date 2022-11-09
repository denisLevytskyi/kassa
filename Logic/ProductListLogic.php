<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$product_list = new Controllers\ProductListController();
$product_list->get_product_list();