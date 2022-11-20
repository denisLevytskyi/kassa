<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Balance: <?php session_start(); echo $_SESSION['balance']['id']; ?></title>
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
				<?php echo $_SESSION['balance']['type']; ?>-ЗВІТ № <?php echo $_SESSION['balance']['id']; ?>
			</p>
			<p class="headerInfoP">
				КАСИР: <?php echo $_SESSION['balance']['auth_name']; ?>
				[<?php echo $_SESSION['balance']['auth_id']; ?>]
			</p>
			<p class="headerInfoP">
				Д/Ч: <?php echo $_SESSION['balance']['time']; ?>
			</p>
		</div>
	</header>
	<section class="main">
			<div class="mainItem">
				<p class="mainItemP mainItemName">
					ЗМІНА ВІДКРИТА: <?php echo $_SESSION['balance']['time_open']; ?>
				</p>
				<p class="mainItemP">
					Перший чек №: <?php echo $_SESSION['balance']['check_first']; ?>
				</p>
			</div>	
			<div class="mainItem">
				<p class="mainItemP mainItemName">
					ЗМІНА ЗАКРИТА: <?php echo $_SESSION['balance']['time_close']; ?>
				</p>
				<p class="mainItemP">
					Останній чек №: <?php echo $_SESSION['balance']['check_last']; ?>
				</p>
			</div>
			<div class="mainItem">
				<p class="mainItemP mainItemName">
					ПРИЙНЯТО ГОТІВКОЮ: <?php echo $_SESSION['balance']['received_cash']; ?> грн
				</p>
				<p class="mainItemP mainItemName">
					ПРИЙНЯТО КАРТКОЮ: <?php echo $_SESSION['balance']['received_card']; ?> грн
				</p>
				<p class="mainItemP">
					Видано решти: <?php echo $_SESSION['balance']['change']; ?>
				</p>
				<p class="mainItemP">
					Видано чеків: <?php echo $_SESSION['balance']['checks']; ?>
				</p>
			</div>				
	</section>
	<footer class="footer">
		<div class="footerSumm">
			<p class="footerSummP">
				<?php echo ('ВСЬОГО: ' . $_SESSION['balance']['summ'] . ' грн'); ?>
			</p>
		</div>
		<div class="footerNum">
			<p class="footerNumP">
				<?php echo ('З НИХ ГОТІВКОЮ: .... ' . $_SESSION['balance']['summ_cash'] . ' грн'); ?>
			</p>
			<p class="footerNumP">
				<?php echo ('З НИХ КАРТКОЮ: ..... ' . $_SESSION['balance']['summ_card'] . ' грн'); ?>
			</p>
			<br>
			<p class="footerNumP">
				<?php echo ('ПОЧАТКОВИЙ ЗАЛИШОК: .... ' . $_SESSION['balance']['balance_open'] . ' грн'); ?>
			</p>
			<p class="footerNumP">
				<?php echo ('СЛУЖБОВЕ ВНЕСЕННЯ: ..... ' . $_SESSION['balance']['staff_in'] . ' грн'); ?>
			</p>
			<p class="footerNumP">
				<?php echo ('СЛУЖБОВЕ ВИЛУЧЕННЯ: ... ' . $_SESSION['balance']['staff_out'] . ' грн'); ?>
			</p>
			<p class="footerNumP">
				<?php echo ('КІНЦЕВИЙ ЗАЛИШОК: .......... ' . $_SESSION['balance']['balance_close'] . ' грн'); ?>
			</p>
		</div>
		<p class="footerFiskal">
			= = = = = = ФІСКАЛЬНИЙ ЧЕК = = = = = =
		</p>
		<p class="footerP">
			UNIKA Fiskal
		</p>
	</footer>
</body>
</html>