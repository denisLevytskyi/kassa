<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$price_list = new Controllers\PriceListController();
$price_list->get_price_list();