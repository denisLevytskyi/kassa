<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PRICE SETTER</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/priceSetter.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Set price</p>
			</div>
		</div>
	</header>
	<section class="priceSetter">
		<div class="container">
			<form action="/priceSetter.php" class="priceSetterForm" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" class="priceSetterFormInp" name="price_setter_article" placeholder="Product Article" required>
				<input type="text" class="priceSetterFormInp" name="price_setter_price" placeholder="Price" required>
				<button type="confirm" class="priceSetterFormBtn">Set Price!</button>
				<a class="priceSetterFormA" href="/">Go Home!</a>
			</form>
		</div>
	</section>
</body>
</html>