<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIGN PAGE</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/sign.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Sign to system</p>
			</div>
		</div>
	</header>
	<section class="sign">
		<div class="container">
			<form action="/sign.php" class="signForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="signFormInp" name="sign_name" placeholder="NAME" required>
				<input type="text" class="signFormInp" name="sign_login" placeholder="EMAIL" required>
				<input type="password" class="signFormInp" name="sign_password_1" placeholder="PASSWORD" required>
				<input type="password" class="signFormInp" name="sign_password_2" placeholder="PASSWORD" required>
				<input type="text" style="display: none;" name="sign_1" value="1" required>
				<button type="submit" class="signFormBtn">Sign Up</button>
			</form>
		</div>
	</section>
</body>
</html>