<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ADD PRODUCT</title>
		<link rel="stylesheet" href="/Styles/main.css">
		<link rel="stylesheet" href="/Styles/addProduct.css">
	</head>
	<body>
		<header class="header">
			<div class="container">
				<div class="headerWrap">
					<img src="/Materials/main_logo.png" class="headerWrapImg">
					<p class="headerWrapP">[LVZ] Add product</p>
				</div>
			</div>
		</header>
		<section class="addProduct">
			<div class="container">
				<form action="/addProduct.php" class="addProductForm" method="POST" enctype="multipart/form-data">
					<input type="text" class="addProductFormInp" name="add_product_art" placeholder="Article" required>
					<input type="text" class="addProductFormInp" name="add_product_code" placeholder="Code" required>
					<input type="text" class="addProductFormInp" name="add_product_gov_code" placeholder="УКТЗЕД">
					<input type="text" class="addProductFormInp" name="add_product_name" placeholder="Name of product" required>
					<input type="text" class="addProductFormInp" name="add_product_description" placeholder="Description" required>
					<select class="addProductFormInp" name="add_product_group" id="list" required>
						<option value="А">А</option>
						<option value="Б">Б</option>
						<option value="В">В</option>
						<option value="Г">Г</option>
						<option value="М+А">М+А</option>
						<option value="М+Г">М+Г</option>
					</select>
					<input type="file" class="addProductFormInp" name="add_product_photo">
					<button type="submit" class="addProductFormBtn">Add!</button>
					<a class="addProductFormA" href="/">Go home!</a>
				</form>
			</div>
		</section>
	</body>
</html>