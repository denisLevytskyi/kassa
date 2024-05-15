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
	<link rel="stylesheet" href="/Styles/priceList.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Price list</p>
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
				<?php foreach ($_SESSION['price_list'] as $k => $v) { ?>
					<div class="listWrapItem">
						<p class="listWrapItemP"><?php
							echo $v['time'] .
								' № => ' . $v['id'] .
								' Price => ' . form($v['price']) .
								' Article => ' . $v['article'] .
								' added by => ' . $v['auth_id'];
						?></p>
					</div>					
				<?php } ?>
			</div>
			<a class="listA" href="/">Go Home</a>
		</div>
	</section>
	<script src="/Scripts/list.js"></script>
</body>
</html>