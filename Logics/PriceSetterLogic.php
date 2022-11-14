<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$price_setter = new Controllers\PriceSetterController();
$price_setter->get_price_setter();