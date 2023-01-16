<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>USER: <?php echo $_SESSION['auth']['name']; ?> </title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/mainPage.css">
	<link rel="stylesheet" href="/Styles/admin.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Admin Panel</p>
			</div>
		</div>
	</header>
	<section class="auth">
		<div class="container">
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
	<section class="list">
		<div class="container">
			<a class="listA" href="/">Go Home!</a>
			<div class="listWrap">
				<?php foreach ($_SESSION['admin'] as $k => $v) { ?>
					<div class="listWrapItem">
						<form action="/admin.php" class="listWrapItemForm" method="POST">
							<p class="listWrapItemFormP">
								ID: <?php echo ($v['id']); ?>
								<br>
								R: <?php echo ($v['role']); ?>
							</p>
							<input type="text" style="display: none;" name="admin_id" value="<?php echo ($v['id']); ?>" required>
							<input type="text" class="listWrapItemFormInp" name="admin_login" value="<?php echo ($v['login']); ?>" required>
							<input type="text" class="listWrapItemFormInp" name="admin_password" value="<?php echo ($v['password']); ?>" required>
							<input type="text" class="listWrapItemFormInp" name="admin_name" value="<?php echo ($v['name']); ?>" required>
							<select class="listWrapItemFormInp" name="admin_role" required>
								<option value="1">ROLE</option>
								<option value="1">User</option>
								<option value="2">Salesman</option>
								<option value="3">Cashier</option>
								<option value="4">Senior cashier</option>
								<option value="100">Admin</option>
							</select>
							<button type="submit" class="listWrapItemFormBtn">
								Upgrade!
							</button>
						</form>
					</div>
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home!</a>
		</div>
	</section>
</body>
</html>