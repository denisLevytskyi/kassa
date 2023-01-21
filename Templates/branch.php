<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BRANCH: <?php session_start(); echo $_SESSION['branch']['id']; ?></title>
	<link rel="stylesheet" href="/Styles/check.css">
</head>
<body>
	<header class="header">
		<a href="/staff.php" class="headerA">
			<img src="/Materials/main_logo.png" class="headerAImg">
		</a>
		<p class="headerP">
			<?php echo $_SESSION['check']['organization_name']; ?>
		</p>
		<p class="headerP">
			<?php echo $_SESSION['check']['store_name']; ?>
		</p>
		<p class="headerP">
			<?php echo $_SESSION['check']['store_address']; ?>
		</p>
		<div class="headerProps">
			<p class="headerPropsP">
				ФН <?php echo $_SESSION['check']['num_fiskal']; ?>
			</p>
			<p class="headerPropsP">
				ІД <?php echo $_SESSION['check']['num_id']; ?>
			</p>
			<p class="headerPropsP">
				ЗН <?php echo $_SESSION['check']['num_factory']; ?>
			</p>
			<p class="headerPropsP">
				ПН <?php echo $_SESSION['check']['num_tax']; ?>
			</p>
		</div>
		<div class="headerInfo">
			<p class="headerInfoNum">
				СЛУЖБОВИЙ ЧЕК № <?php echo $_SESSION['branch']['id']; ?>
			</p>
			<p class="headerInfoP">
				КАСИР: <?php echo $_SESSION['branch']['auth_name']; ?>
				[<?php echo $_SESSION['branch']['auth_id']; ?>]
			</p>
			<p class="headerInfoP">
				Д/Ч: <?php echo $_SESSION['branch']['time']; ?>
			</p>
			<p class="headerInfoP">
				Z-ЗВІТ: <?php echo $_SESSION['branch']['z_id']; ?>
			</p>
			<p class="headerInfoP">
				КАСА: <?php echo $_SESSION['check']['store_kass']; ?>
			</p>
		</div>
	</header>
	<section class="main">
		<div class="mainItem">
			<p class="mainItemP mainItemName">
				<?php echo $_SESSION['branch']['type']; ?>
			</p>
			<p class="mainItemP">
				СУМА: <?php echo ($_SESSION['branch']['sum'] . ' грн'); ?>
			</p>
		</div>
	</section>
	<footer class="footer">
		<div class="footerSum">
			<p class="footerSumP">
				<?php echo ('ВСЬОГО: ' . $_SESSION['branch']['sum'] . ' грн'); ?>
			</p>
		</div>
		<div class="footerNum">
			<p class="footerNumP"><?php
				if ($_SESSION['branch']['type'] == "СЛУЖБОВЕ ВНЕСЕННЯ") {
					echo ('ОТРИМАНО ГОТІВКОЮ: .... ' . $_SESSION['branch']['sum'] . ' грн');
				} else {
					echo ('ВИДАНО ГОТІВКОЮ: .... ' . $_SESSION['branch']['sum'] . ' грн');
				}
			?></p>
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
