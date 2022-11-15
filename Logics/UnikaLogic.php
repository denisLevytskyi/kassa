<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$unika = new Controllers\UnikaController();
$unika->get_unika();