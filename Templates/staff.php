<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>USER: <?php echo $_SESSION['auth']['name']; ?> </title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/mainPage.css">
	<link rel="stylesheet" href="/Styles/staff.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Staff Panel</p>
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
	<section class="staff">
		<div class="container">
			<form action="/staff.php" class="staffForm" method="POST">
				<input type="text" class="serachFormInp" name="staff_branch_summ" placeholder="Branch Summ" required>
				<button type="confirm" class="staffFormBtn">Add branch!</button>
			</form>
			<a href="/staff.php/?staff_balance=z" class="staffA">
				GET Z-BALANCE!
			</a>
			<a href="/staff.php/?staff_balance=x" class="staffA">
				GET X-BALANCE!
			</a>
		</div>
	</section>
	<section class="list">
		<div class="container">
			<div class="listWrap">
				<?php foreach ($_SESSION['staff']['branches'] as $k => $v) { ?>
					<div class="listWrapItem">
						<a href="/branch.php/?branch_id=<?php echo ($v['id']); ?>" class="listWrapItemP"><?php
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
	<section class="list">
		<div class="container">
			<div class="listWrap">
				<?php foreach ($_SESSION['staff']['balances'] as $k => $v) { ?>
					<div class="listWrapItem">
						<a href="/balance.php/?balance_id=<?php echo ($v['id']); ?>" class="listWrapItemP"><?php
							echo($v['time'] .
								' № => ' . $v['id'] .
								' Summ => ' . $v['summ'] .
								' added by => ' . $v['auth_id'] .
								' ' . $v['auth_name']);
						?></a>
					</div>					
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home!</a>
		</div>
	</section>
</body>
</html>
