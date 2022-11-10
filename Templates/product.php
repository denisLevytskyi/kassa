<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PRODUCT PAGE</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/product.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Product page</p>
			</div>
		</div>
	</header>
	<section class="product">
		<div class="container">
			<?php $v = $_SESSION['product']; ?>
			<form action="/product.php" class="productForm" method="POST" enctype="application/x-www-form-urlencoded">
				<img src="<?php echo ($v['foto']); ?>" alt="" class="productFormImg">
				<pre class="productFormP">Create User with ID: <?php echo($v['auth_id']);?></pre>
				<pre class="productFormP">Product ID: <?php echo($v['id']);?></pre>
				<p class="productFormP">
					Article
				</p>
				<input type="text" class="productFormInp" name="edit_product_art" value="<?php echo($v['article']);?>" required>
				<p class="productFormP">
					Code
				</p>
				<input type="text" class="productFormInp" name="edit_product_code" value="<?php echo($v['code']);?>" required>
				<p class="productFormP">
					Name
				</p>
				<input type="text" class="productFormInp" name="edit_product_name" value="<?php echo($v['name']);?>" required>
				<p class="productFormP">
					Description
				</p>
				<textarea name="edit_product_desc" rows="7" class="productFormInp" required><?php echo($v['description']);?></textarea>
				<input type="text" style="display: none;" name="edit_product_1" value="1" required>
				<button type="confirm" class="productFormBtn">Edit!</button>
				<a class="productFormA" href="/product.php/?delete=1">Delete product!</a>
				<a class="productFormA" href="/productList.php">Go Back!</a>
			</form>
		</div>
	</section>
</body>
</html>