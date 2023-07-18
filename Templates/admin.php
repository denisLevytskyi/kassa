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
	<section class="list">
		<div class="container typicalContainer">
			<a class="listA" href="/">Go Home!</a>
			<div class="listWrap">
				<?php foreach ($_SESSION['admin'] as $k => $v) { ?>
					<div class="listWrapItem">
						<p class="listWrapItemP">
							ID: <?php echo $v['id']; ?>
							|
							Role: <?php echo $v['role']; ?>
						</p>
						<form action="/admin.php" class="listWrapItemForm" method="POST">
							<input type="text" style="display: none;" name="admin_id" value="<?php echo $v['id']; ?>" required>
							<p class="listWrapItemFormP">
								Login:
							</p>
							<input type="text" class="listWrapItemFormInp" name="admin_login" value="<?php echo $v['login']; ?>" required>
							<p class="listWrapItemFormP">
								Password:
							</p>
							<input type="text" class="listWrapItemFormInp" name="admin_password" value="<?php echo $v['password']; ?>" required>
							<p class="listWrapItemFormP">
								Name:
							</p>
							<input type="text" class="listWrapItemFormInp" name="admin_name" value="<?php echo $v['name']; ?>" required>
							<p class="listWrapItemFormP">
								Role:
							</p>
							<select class="listWrapItemFormInp" name="admin_role" required>
								<option value="1" <?php echo $v['role'] == 1 ? 'selected' : ''; ?>>User</option>
								<option value="2" <?php echo $v['role'] == 2 ? 'selected' : ''; ?>>Salesman</option>
								<option value="3" <?php echo $v['role'] == 3 ? 'selected' : ''; ?>>Cashier</option>
								<option value="4" <?php echo $v['role'] == 4 ? 'selected' : ''; ?>>Senior cashier</option>
								<option value="10" <?php echo $v['role'] == 10 ? 'selected' : ''; ?>>Admin</option>
								<option value="99" <?php echo $v['role'] == 99 ? 'selected' : ''; ?>>Super Admin</option>
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