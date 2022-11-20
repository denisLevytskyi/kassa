<?php
$login = new Controllers\LoginController();
$login->get_login_check(); 
$branch = new Controllers\BranchController();
$branch->get_branch_check();