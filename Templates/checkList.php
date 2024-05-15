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
		<div class="container typicalContainer">
			<p class="authP">
				ID: <?php echo $_SESSION['auth']['id']; ?>
				Name: <?php echo $_SESSION['auth']['name']; ?>
			</p>
			<a href="/?auth_disconnect=1" class="authA">
				Disconnect
			</a>
			<a href="/editAuth.php" class="authA">
				Edit
			</a>
		</div>
	</section>
	<section class="search">
		<div class="container typicalContainer">
			<form action="/check.php" class="searchForm" method="GET">
				<input type="text" class="searchFormInp" name="check_data" placeholder="ID or Sum" required>
				<button type="submit" class="searchFormBtn">Search</button>
			</form>
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
				<?php foreach ($_SESSION['check_list'] as $k => $v) {
					$type = null;
					if ($v['type'] == 'АНУЛЬОВАНО') {
						$type = 'null';
					} elseif ($v['type'] == 'ВИДАТКОВИЙ ЧЕК') {
						$type = 'return';
					} ?>
					<div class="listWrapItem <?php echo $type; ?>">
						<a href="/check.php/?check_id=<?php echo $v['id']; ?>" class="listWrapItemA"><?php
							echo $v['time'] .
								' № => ' . $v['id'] .
								' Z-bal => ' . $v['z_id'] .
								' Sum => ' . form($v['sum']) .
								' Type => ' . $v['type'] .
								' added by => ' . $v['auth_id'] .
								' ' . $v['auth_name'];
						?></a>
						<a href="/checkList.php/?check_id=<?php echo $v['id']; ?>" class="listWrapItemAGo">
							<nobr>To Go</nobr>
						</a>
					</div>					
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home</a>
		</div>
	</section>
	<script src="/Scripts/list.js"></script>
</body>
</html>