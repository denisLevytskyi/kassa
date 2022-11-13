<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SING PAGE</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/sing.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Sing to system</p>
			</div>
		</div>
	</header>
	<section class="sing">
		<div class="container">
			<form action="/sing.php" class="singForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="singFormInp" name="sing_name" placeholder="NAME" required>
				<input type="text" class="singFormInp" name="sing_login" placeholder="EMAIL" required>
				<input type="password" class="singFormInp" name="sing_password_1" placeholder="PASSWORD" required>
				<input type="password" class="singFormInp" name="sing_password_2" placeholder="PASSWORD" required>
				<input type="text" style="display: none;" name="sing_1" value="1" required>
				<button type="confirm" class="singFormBtn">Sing In!</button>
			</form>
		</div>
	</section>
</body>
</html>


