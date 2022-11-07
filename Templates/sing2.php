<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SING PAGE</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/sing.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Sing to system</p>
			</div>
		</div>
	</header>
	<section class="sing">
		<div class="container">
			<form action="/sing.php" class="singForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="singFormInp" name="sing_name" value="<?php echo($_POST['sing_name']);?>" readonly>
				<input type="text" class="singFormInp" name="sing_login" value="<?php echo($_POST['sing_login']);?>" readonly>
				<input type="password" class="singFormInp" name="sing_password_1" value="<?php echo($_POST['sing_password_1']);?>" readonly>
				<input type="password" class="singFormInp" name="sing_password_2" value="<?php echo($_POST['sing_password_1']);?>" readonly>
				<input type="text" class="singFormInp" name="sing_pin_1" placeholder="PIN frow Email" required>
				<input type="text" class="singFormInp" name="sing_pin_2" placeholder="PIN of Admin" required>
				<input type="text" style="display: none;" name="sing_2" value="1" required>
				<button type="confirm" class="singFormBtn">Sing In!</button>
			</form>
		</div>
	</section>
</body>
</html>


