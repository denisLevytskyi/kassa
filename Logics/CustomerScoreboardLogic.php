<?php
$login = new Controllers\LoginController();
$login->get_login_check();
$admin = new Controllers\AdminController();
$admin->get_admin_check(3);
$scoreboard = new Controllers\CustomerScoreboardController();
$scoreboard->get_scoreboard();