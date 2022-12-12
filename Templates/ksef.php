<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>USER: <?php echo $_SESSION['auth']['name']; ?> </title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/mainPage.css">
	<link rel="stylesheet" href="/Styles/ksef.css">
</head>
<body>
<header class="header">
	<div class="container">
		<div class="headerWrap">
			<img src="/Materials/main_logo.png" class="headerWrapImg">
			<p class="headerWrapP">[LVZ] KSEF</p>
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
		<div class="listWrap">
			<?php foreach ($_SESSION['ksef'] as $k => $v) { ?>
				<div class="listWrapItem">
					<a href="/Ksef/<?php echo $v; ?>" class="listWrapItemA">
						<?php echo $v; ?>
					</a>
				</div>
			<?php } ?>
		</div>
		<a class="listA" href="/">Go Home!</a>
	</div>
</section>
</body>
</html>