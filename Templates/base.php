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
		<title>USER: <?php echo $_SESSION['auth']['name']; ?> </title>
		<link rel="stylesheet" href="/Styles/main.css">
		<link rel="stylesheet" href="/Styles/mainPage.css">
		<link rel="stylesheet" href="/Styles/base.css">
	</head>
	<body>
		<header class="header">
			<div class="container">
				<div class="headerWrap">
					<img src="/Materials/main_logo.png" class="headerWrapImg">
					<p class="headerWrapP">[LVZ] Base Panel</p>
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
		<section class="base">
			<div class="container typicalContainer">
				<a href="/base.php/?base_get=1" class="baseA">
					GET DOCUMENTS!
				</a>
				<a href="/base.php/?base_set=1" class="baseA">
					SET DOCUMENTS!
				</a>
				<a href="/base.php/?base_cancel=1" class="baseA">
					CANCEL DOCUMENTS!
				</a>
				<a href="/base.php/?base_truncate=1" class="baseA">
					DROP BASE!
				</a>
			</div>
		</section>
		<section class="list">
			<div class="container typicalContainer">
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
					<?php foreach ($_SESSION['base']['branches'] as $k => $v) {
						$type = null;
						if ($v['type'] == 'НУЛЬОВИЙ ЧЕК') {
							$type = 'null';
						} elseif ($v['type'] == 'СЛУЖБОВЕ ВИЛУЧЕННЯ') {
							$type = 'out';
						} ?>
						<div class="listWrapItem <?php echo $type; ?>">
							<a href="/base.php/?base_view_type=base_branch&base_view_id=<?php echo $v['id']; ?>" class="listWrapItemA"><?php
								echo $v['time'] .
									' № => ' . $v['id'] .
									' Kass => ' . $v['store_kass'] .
									' № => ' . $v['i_id'] .
									' Z-bal => ' . $v['z_id'] .
									' Sum => ' . form($v['sum']) .
									' Type => ' . $v['type'] .
									' added by => ' . $v['auth_id'] .
									' ' . $v['auth_name'];
								?></a>
						</div>
					<?php } ?>
				</div>
				<a class="listA" href="/">Go Home!</a>
			</div>
		</section>
		<section class="list">
			<div class="container typicalContainer">
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
					<?php foreach ($_SESSION['base']['balances'] as $k => $v) { ?>
						<div class="listWrapItem">
							<a href="/base.php/?base_view_type=base_balance&base_view_id=<?php echo $v['id']; ?>" class="listWrapItemA"><?php
								echo $v['time'] .
									' № => ' . $v['id'] .
									' Kass => ' . $v['store_kass'] .
									' № => ' . $v['i_id'] .
									' Sum => ' . form($v['sum']) .
									' added by => ' . $v['auth_id'] .
									' ' . $v['auth_name'];
								?></a>
						</div>
					<?php } ?>
				</div>
				<a class="listA" href="/">Go Home!</a>
			</div>
		</section>
		<section class="list">
			<div class="container typicalContainer">
				<div class="listBtn">
					<p class="listBtnP deactivate" id="previous3">
						Previous
					</p>
					<p class="listBtnP deactivate" id="next3">
						Next
					</p>
					<p class="listBtnP deactivate" id="all3">
						All
					</p>
				</div>
				<div class="listWrap" id="listWrap3">
					<?php foreach ($_SESSION['base']['checks'] as $k => $v) {
						$type = null;
						if ($v['type'] == 'АНУЛЬОВАНО') {
							$type = 'null';
						} elseif ($v['type'] == 'ВИДАТКОВИЙ ЧЕК') {
							$type = 'return';
						} ?>
						<div class="listWrapItem <?php echo $type; ?>">
							<a href="/base.php/?base_view_type=base_check&base_view_id=<?php echo $v['id']; ?>" class="listWrapItemA"><?php
								echo $v['time'] .
										' № => ' . $v['id'] .
										' Kass => ' . $v['store_kass'] .
										' № => ' . $v['i_id'] .
										' Z-bal => ' . $v['z_id'] .
										' Sum => ' . form($v['sum']) .
										' Type => ' . $v['type'] .
										' added by => ' . $v['auth_id'] .
										' ' . $v['auth_name'];
								?></a>
						</div>
					<?php } ?>
				</div>
				<a class="listA" href="/">Go Home!</a>
			</div>
		</section>
		<script src="/Scripts/list.js"></script>
		<script>
            list_function('2', 15);
			list_function('3', 30);
		</script>
	</body>
</html>