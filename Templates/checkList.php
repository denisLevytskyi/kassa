<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>USER: <?php echo $_SESSION['auth']['name']; ?> </title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/mainPage.css">
	<link rel="stylesheet" href="/Styles/checkList.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Check list</p>
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
	<section class="search">
		<div class="container">
			<form action="/check.php" class="searchForm" method="GET">
				<input type="text" class="serachFormInp" name="check_data" placeholder="ID or Summ" required>
				<button type="confirm" class="searchFormBtn">Serch!</button>
			</form>
		</div>
	</section>
	<section class="list">
		<div class="container">
			<div class="listWrap">
				<?php foreach ($_SESSION['check_list'] as $k => $v) { ?>
					<div class="listWrapItem">
						<a href="/check.php/?check_id=<?php echo ($v['id']); ?>" class="listWrapItemP"><?php
							echo($v['time'] .
								' № => ' . $v['id'] .
								' Z-bal => ' . $v['z_id'] .
								' Summ => ' . $v['summ'] .
								' Type => ' . $v['type'] .
								' added by => ' . $v['auth_id'] .
								' ' . $v['auth_name']
							);
						?></a>
					</div>					
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home!</a>
		</div>
	</section>
</body>
</html>