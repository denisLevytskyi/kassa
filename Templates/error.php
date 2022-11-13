<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ERROR!</title>
	<link rel="stylesheet" href="/Styles/main.css">
	<link rel="stylesheet" href="/Styles/error.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="/Materials/main_logo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Error page</p>
			</div>
		</div>
	</header>
	<section class="error">
		<div class="container">
			<h1 class="errorH1">
				ERROR!
			</h1>
			<p class="errorP">
				Error code: <?php session_start(); echo $_SESSION['error']['n']; ?>
			</p>
			<p class="errorP">
				Error description: <?php echo $_SESSION['error']['desc']; ?>
			</p>
			<a class="errorA" href="/">Go Home!</a>
		</div>
	</section>
</body>
</html>


	
	