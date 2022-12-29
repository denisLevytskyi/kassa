<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(3);
$check_list = new Controllers\CheckListController();
$check_list->get_check_list();