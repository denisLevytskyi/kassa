<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RESET PASSWORD</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/reset.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Reset password</p>
			</div>
		</div>
	</header>
	<section class="reset">
		<div class="container">
			<form action="/reset.php" class="resetForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="resetFormInp" name="reset_login" placeholder="Login (Email)" required>
				<button type="submit" class="resetFormBtn">Reset!</button>
				<a class="resetFormA" href="/">Go Home!</a>
			</form>
		</div>
	</section>
</body>
</html>