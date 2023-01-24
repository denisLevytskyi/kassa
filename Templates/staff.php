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
			<p class="staffP">
				Balance: <?php echo $_SESSION['staff']['balance']; ?>
			</p>
		</div>
	</section>
	<section class="staff">
		<div class="container">
			<form action="/staff.php" class="staffForm" method="POST">
				<input type="text" class="staffFormInp" name="staff_branch_sum" value="-<?php echo $_SESSION['staff']['balance']; ?>" required>
				<button type="submit" class="staffFormBtn">Add branch!</button>
			</form>
		</div>
	</section>
	<section class="staff">
		<div class="container">
			<form action="/staff.php" class="staffForm" method="POST">
				<input type="number" step="1" class="staffFormInp" name="staff_periodical_f" placeholder="Z-id first" required>
				<input type="number" step="1" class="staffFormInp" name="staff_periodical_l" placeholder="Z-id last" required>
				<button type="submit" class="staffFormBtn">Get periodical!</button>
			</form>
			<a href="/staff.php/?staff_balance=Z" class="staffA">
				GET Z-BALANCE!
			</a>
			<a href="/staff.php/?staff_balance=X" class="staffA">
				GET X-BALANCE!
			</a>
		</div>
	</section>
	<section class="list">
		<div class="container">
			<div class="listBtn">
				<p class="listBtnP deactivate" id="previous">
					Previous
				</p>
				<p class="listBtnP deactivate" id="next">
					Next
				</p>
				<p class="listBtnP deactivate" id="all">
					All
				</p>
			</div>
			<div class="listWrap" id="listWrap">
				<?php foreach ($_SESSION['staff']['branches'] as $k => $v) {
					$type = null;
					if ($v['type'] == 'НУЛЬОВИЙ ЧЕК') {
						$type = 'null';
					} elseif ($v['type'] == 'СЛУЖБОВЕ ВИЛУЧЕННЯ') {
						$type = 'out';
					} ?>
					<div class="listWrapItem <?php echo $type; ?>">
						<a href="/branch.php/?branch_id=<?php echo ($v['id']); ?>" class="listWrapItemA"><?php
							echo($v['time'] .
								' № => ' . $v['id'] .
								' Z-bal => ' . $v['z_id'] .
								' Sum => ' . $v['sum'] .
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
			<div class="listBtn">
				<p class="listBtnP deactivate" id="previous2">
					Previous
				</p>
				<p class="listBtnP deactivate" id="next2">
					Next
				</p>
				<p class="listBtnP deactivate" id="all2">
					All
				</p>
			</div>
			<div class="listWrap" id="listWrap2">
				<?php foreach ($_SESSION['staff']['balances'] as $k => $v) { ?>
					<div class="listWrapItem">
						<a href="/balance.php/?balance_id=<?php echo ($v['id']); ?>" class="listWrapItemA"><?php
							echo($v['time'] .
								' № => ' . $v['id'] .
								' Sum => ' . $v['sum'] .
								' added by => ' . $v['auth_id'] .
								' ' . $v['auth_name']);
						?></a>
					</div>					
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home!</a>
		</div>
	</section>
	<script src="/Scripts/list.js"></script>
	<script>
		list_function('2');
	</script>
</body>
</html>