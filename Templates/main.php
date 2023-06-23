<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hello <?php session_start(); echo $_SESSION['auth']['name']; ?> </title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/mainPage.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Main page</p>
			</div>
		</div>
	</header>
	<section class="auth">
		<div class="container typicalContainer">
			<p class="authP">
				ID: <?php echo $_SESSION['auth']['id']; ?>
				Name: <?php echo $_SESSION['auth']['name']; ?>
			</p>
			<a href="/?auth_disconnect=1" class="authA">
				Disconnect!
			</a>
			<a href="/editAuth.php" class="authA">
				Edit!
			</a>
		</div>
	</section>
	<section class="links">
		<div class="container typicalContainer">
			<h1 class="linksH1">
				Available actions:
			</h1>
			<div class="linksWrapper">
				<a href="/addProduct.php" class="linksWrapperA">
					Add product
				</a>
				<a href="/productList.php" class="linksWrapperA">
					Get product List
				</a>
				<a href="/priceSetter.php" class="linksWrapperA">
					Price Setter
				</a>
				<a href="/priceList.php" class="linksWrapperA">
					Get price List
				</a>
				<a href="/unika.php" class="linksWrapperA">
					Unika
				</a>
				<a href="/checkList.php" class="linksWrapperA">
					Get check List
				</a>
				<a href="/staff.php" class="linksWrapperA">
					Staff Panel
				</a>
				<a href="/admin.php" class="linksWrapperA">
					Admin Panel
				</a>
				<a href="/ksef.php" class="linksWrapperA">
					KSEF
				</a>
				<a href="/base.php" class="linksWrapperA">
					Base Panel
				</a>
			</div>
		</div>
	</section>
</body>
</html>