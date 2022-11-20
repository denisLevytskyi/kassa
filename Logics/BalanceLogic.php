<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$balance = new Controllers\BalanceController();
$balance->get_balance_check();