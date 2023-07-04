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
		<title>SUM: <?php session_start(); echo form($_SESSION['scoreboard']['check_sum']); ?></title>
		<link rel="stylesheet" href="/Styles/main.css">
		<link rel="stylesheet" href="/Styles/customerScoreboard.css">
	</head>
	<body>
		<header class="header">
			<div class="headerContainer">
				<p class="headerContainerP"><?php
					echo $_SESSION['scoreboard']['name'] .
							'<br>' .
							form($_SESSION['scoreboard']['price']) .
							' X ' .
							$_SESSION['scoreboard']['amount'] .
							' = ' .
							form($_SESSION['scoreboard']['sum']) .
							' ==> ' .
							form($_SESSION['scoreboard']['check_sum']);
					?></p>
			</div>
		</header>
		<script src="/Scripts/autoload.js"></script>
	</body>
</html>