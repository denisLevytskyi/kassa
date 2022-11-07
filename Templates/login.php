<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN PAGE</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/login.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Login to system</p>
			</div>
		</div>
	</header>
	<section class="login">
		<div class="container">
			<form action="/index.php" class="loginForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="loginFormInp" name="login_login" placeholder="LOGIN" required>
				<input type="password" class="loginFormInp" name="login_password" placeholder="PASSWORD" required>
				<div class="loginFormRem">
					<input type="checkbox" class="loginFormRemCheck" name="login_remember" checked>
					<p>Remember Me!</p>
				</div>
				<button type="confirm" class="loginFormBtn">Login In!</button>
				<a class="loginFormA" href="/sing.php">Sing In</a>
			</form>
		</div>
	</section>
</body>
</html>


