<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CHECK: <?php session_start(); echo $_SESSION['check']['id']; ?></title>
	<link rel="stylesheet" href="/Styles/check.css">
</head>
<body>
	<header class="header">
		<a href="/unika.php" class="headerA">
			<img src="/Materials/main_logo.png" class="headerAImg">
		</a>
		<p class="headerP">
			ТОВ "LVZ"
		</p>
		<p class="headerP">
			Магазин "LVZ STORE"
		</p>
		<p class="headerP">
			Україна, Волинська обл., м. Луцьк,<br>пр. Волі, буд. 22
		</p>
		<div class="headerInfo">
			<p class="headerInfoNum">
				ПРЕЧЕК № <?php echo $_SESSION['check']['id']; ?>
			</p>
			<p class="headerInfoP">
				КАСИР: <?php echo $_SESSION['check']['auth_name']; ?>
				[<?php echo $_SESSION['check']['auth_id']; ?>]
			</p>
			<p class="headerInfoP">
				Д/Ч: <?php echo $_SESSION['check']['time']; ?>
			</p>
		</div>
	</header>
	<section class="main">
		<?php foreach ($_SESSION['check']['main'] as $k => $v) { ?>
			<div class="mainItem">
				<p class="mainItemP">
					<?php echo ($v['price'] . ' X ' . $v['amount'] . ' = ' . $v['summ']); ?>
				</p>
				<p class="mainItemP mainItemName">
					<?php echo ($v['name']); ?>
				</p>
				<p class="mainItemP">
					<?php echo ('Ш/К: ' . $v['code']); ?>
				</p>
				<p class="mainItemP">
					<?php echo ('АРТИКУЛ: ' . $v['article']); ?>
				</p>
			</div>					
		<?php } ?>
	</section>
	<footer class="footer">
		<div class="footerSumm">
			<p class="footerSummP">
				<?php echo ('ВСЬОГО: ' . $_SESSION['check']['summ'] . ' грн'); ?>
			</p>
		</div>
		<div class="footerNum">
			<p class="footerNumP">
				<?php echo ('ОТРИМАНО ГОТІВКОЮ: .... ' . $_SESSION['check']['received_cash'] . ' грн'); ?>
			</p>
			<p class="footerNumP">
				<?php echo ('ОТРИМАНО КАРТКОЮ: ..... ' . $_SESSION['check']['received_card'] . ' грн'); ?>
			</p>
			<p class="footerNumP">
				<?php echo ('РЕШТА: ................................ ' . $_SESSION['check']['change'] . ' грн'); ?>
			</p>
		</div>
		<p class="footerFiskal">
			= = = = = НЕФІСКАЛЬНИЙ ЧЕК = = = = =
		</p>
		<p class="footerP">
			UNIKA Fiskal
		</p>
	</footer>
</body>
</html>