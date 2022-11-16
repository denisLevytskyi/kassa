<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$check_list = new Controllers\CheckListController();
$check_list->get_check_list();