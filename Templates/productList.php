<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>USER: <?php session_start(); echo $_SESSION['auth_name']; ?> </title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/mainPage.css">
	<link rel="stylesheet" href="/css/productList.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Product list</p>
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
	<section class="search">
		<div class="container">
			<form action="/product.php" class="searchForm" method="GET">
				<input type="text" class="serachFormInp" name="product_art" placeholder="Article" required>
				<button type="confirm" class="searchFormBtn">Serch!</button>
			</form>
		</div>
	</section>
	<section class="list">
		<div class="container">
			<div class="listWrap">
				<?php foreach ($_SESSION['product_list'] as $k => $v) { ?>
					<div class="listWrapItem">
						<img src="<?php echo ($v['foto']); ?>" alt="" class="listWrapItemImg">
						<a href="/product.php/?product_id=<?php echo ($v['id']); ?>" class="listWrapItemA">
							<?php echo ($v['article'] . ' ' . $v['name']); ?>
						</a>
					</div>					
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home!</a>
		</div>
	</section>
</body>
</html>
