<?php
function form ($num) {
	return number_format($num, 2, '.', ' ');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PRODUCT PAGE</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/product.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Product page</p>
			</div>
		</div>
	</header>
	<section class="product">
		<div class="container">
			<?php $v = $_SESSION['product']; ?>
			<form action="/product.php" class="productForm" method="POST" enctype="multipart/form-data">
				<img src="<?php echo $v['photo']; ?>" alt="" class="productFormImg">
				<pre class="productFormP">Create User with ID: <?php echo $v['auth_id'];?></pre>
				<pre class="productFormP">Product ID: <?php echo $v['id'];?></pre>
				<pre class="productFormP">Price: <?php echo form($v['price']);?></pre>
				<br>
				<input type="text" style="display: none;" name="edit_product_id" value="<?php echo $v['id'];?>" required>
				<p class="productFormP">
					Article
				</p>
				<input type="text" class="productFormInp" name="edit_product_art" value="<?php echo $v['article'];?>" required>
				<p class="productFormP">
					Code
				</p>
				<input type="text" class="productFormInp" name="edit_product_code" value="<?php echo $v['code'];?>" required>
				<p class="productFormP">
					УКТЗЕД
				</p>
				<input type="text" class="productFormInp" name="edit_product_gov_code" value="<?php echo $v['gov_code'];?>">
				<p class="productFormP">
					Name
				</p>
				<input type="text" class="productFormInp" name="edit_product_name" value="<?php echo $v['name'];?>" required>
				<p class="productFormP">
					Tax group
				</p>
				<select class="productFormInp" name="edit_product_group" id="list" required>
					<option value="А" <?php echo $v['group'] == 'А' ? 'selected' : ''; ?>>А</option>
					<option value="Б" <?php echo $v['group'] == 'Б' ? 'selected' : ''; ?>>Б</option>
					<option value="В" <?php echo $v['group'] == 'В' ? 'selected' : ''; ?>>В</option>
					<option value="Г" <?php echo $v['group'] == 'Г' ? 'selected' : ''; ?>>Г</option>
					<option value="М+А" <?php echo $v['group'] == 'М+А' ? 'selected' : ''; ?>>М+А</option>
					<option value="М+Г" <?php echo $v['group'] == 'М+Г' ? 'selected' : ''; ?>>М+Г</option>
				</select>
				<p class="productFormP">
					Description
				</p>
				<textarea name="edit_product_description" rows="7" class="productFormInp" required><?php echo $v['description'];?></textarea>
				<p class="productFormP">
					New Photo
				</p>
				<input type="file" class="productFormInp" name="edit_product_photo">
				<input type="text" style="display: none;" name="edit_product_old_photo" value="<?php echo $v['photo'];?>" required>
				<button type="submit" class="productFormBtn">Edit!</button>
				<a class="productFormA" href="/product.php/?product_delete=1">Delete product!</a>
				<a class="productFormA" href="/productList.php">Go Back!</a>
			</form>
		</div>
	</section>
</body>
</html>