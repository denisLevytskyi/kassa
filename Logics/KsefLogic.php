<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$ksef = new Controllers\KsefController();
$ksef->get_ksef();