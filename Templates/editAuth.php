<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EDIT PAGE</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/editAuth.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Editing profile</p>
			</div>
		</div>
	</header>
	<section class="editAuth">
		<div class="container">
			<form action="/editAuth.php" class="editAuthForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="editAuthFormInp" name="edit_auth_id" value="<?php echo($_SESSION['auth_id']);?>" readonly>
				<input type="text" class="editAuthFormInp" name="edit_auth_name" value="<?php echo($_SESSION['auth_name']);?>">
				<input type="text" class="singFormInp" name="edit_auth_login" value="<?php echo($_SESSION['auth_login']);?>">
				<input type="password" class="editAuthFormInp" name="edit_auth_password_1" placeholder="NEW PASWWORD" required>
				<input type="password" class="editAuthFormInp" name="edit_auth_password_2" placeholder="NEW PASWWORD" required>
				<input type="text" style="display: none;" name="edit_auth_1" value="1" required>
				<button type="confirm" class="editAuthFormBtn">Edit!</button>
				<a class="editAuthFormA" href="/editAuth.php/?delete=1">Delete profile!</a>
				<a class="editAuthFormA" href="/">Go Home!</a>
			</form>
		</div>
	</section>
</body>
</html>


