<?php
include "Scripts/qrcode.php";
QRcode::png($_GET['data'], FALSE, 'M', 20, 0);