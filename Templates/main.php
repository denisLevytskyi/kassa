<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hello <?php session_start(); echo $_SESSION['auth_name']; ?> </title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/main_page.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Main page</p>
			</div>
		</div>
	</header>
	<section class="auth">
		<div class="container">
			<p class="authP">
				ID: <?php session_start(); echo $_SESSION['auth_id']; ?>
				Name: <?php session_start(); echo $_SESSION['auth_name']; ?>
			</p>
			<a href="/?disconnect=1" class="authA">
				Disconnect!
			</a>
			<a href="/editAuth.php" class="authA">
				Edit!
			</a>
		</div>
	</section>
	<section class="links">
		<div class="container">
			<h1 class="linksH1">
				Available actions:
			</h1>
			<div class="linksWrapper">
				<a href="/addProduct.php" class="linksWrapperA">
					Add product
				</a>
				<a href="" class="linksWrapperA">
					Get product List
				</a>
			</div>
		</div>
	</section>
</body>
</html>
