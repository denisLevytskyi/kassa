<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$edit_auth = new Controllers\EditAuthController();
$edit_auth->get_edit_auth_check(); 