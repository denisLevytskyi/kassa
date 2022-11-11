<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$product = new Controllers\ProductController();
$product->get_product();