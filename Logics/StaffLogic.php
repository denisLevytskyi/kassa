<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$staff = new Controllers\StaffController();
$staff->get_staff_check(); 