<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EDIT PAGE</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/addProduct.css">
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
	<section class="addProduct">
		<div class="container">
			<form action="/addProduct.php" class="addProductForm" method="POST" enctype="multipart/form-data">
				<input type="text" class="addProductFormInp" name="add_product_art" placeholder="Article" required>
				<input type="text" class="addProductFormInp" name="add_product_code" placeholder="Code" required>
				<input type="text" class="addProductFormInp" name="add_product_name" placeholder="Name of product" required>
				<input type="text" class="addProductFormInp" name="add_product_description" placeholder="Description" required>
				<input type="file" class="addProductFormInp" name="add_product_foto">
				<input type="text" style="display: none;" name="add_product_1" value="1" required>
				<button type="confirm" class="addProductFormBtn">Add!</button>
				<a class="addProductFormA" href="/">Go home!</a>
			</form>
		</div>
	</section>
</body>
</html>