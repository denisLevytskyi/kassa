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
	<title>Balance: <?php session_start(); echo $_SESSION['balance']['id']; ?></title>
	<link rel="stylesheet" href="/Styles/check.css">
</head>
<body>
	<header class="header">
		<a href="/staff.php" class="headerA">
			<img src="/Materials/main_logo.png" class="headerAImg">
		</a>
		<p class="headerP">
			<?php echo $_SESSION['balance']['organization_name']; ?>
		</p>
		<p class="headerP">
			<?php echo $_SESSION['balance']['store_name']; ?>
		</p>
		<p class="headerP">
			<?php echo $_SESSION['balance']['store_address']; ?>
		</p>
		<div class="headerProps">
			<p class="headerPropsP">
				ФН <?php echo $_SESSION['balance']['num_fiskal']; ?>
			</p>
			<p class="headerPropsP">
				ІД <?php echo $_SESSION['balance']['num_id']; ?>
			</p>
			<p class="headerPropsP">
				ЗН <?php echo $_SESSION['balance']['num_factory']; ?>
			</p>
			<p class="headerPropsP">
				ПН <?php echo $_SESSION['balance']['num_tax']; ?>
			</p>
		</div>
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
		<div class="mainItem c<?php echo $_SESSION['balance']['null_checks']; ?>">
			<p class="mainItemP mainItemName">
				= = = = = = АНУЛЬОВАНО = = = = = =
			</p>
			<p class="mainItemP">
				Перший чек №: <?php echo $_SESSION['balance']['null_id_first']; ?>
			</p>
			<p class="mainItemP">
				Д/Ч: <?php echo $_SESSION['balance']['null_time_first']; ?>
			</p>
			<p class="mainItemP">
				Останній чек №: <?php echo $_SESSION['balance']['null_id_last']; ?>
			</p>
			<p class="mainItemP">
				Д/Ч: <?php echo $_SESSION['balance']['null_time_last']; ?>
			</p>
			<p class="mainItemP">
				Чеків: <?php echo $_SESSION['balance']['null_checks']; ?>
			</p>
		</div>
		<br>
		<div class="mainItem">
			<p class="mainItemP mainItemName">
				= = = = = = ПРОДАЖІ = = = = = = = = =
			</p>
			<p class="mainItemP">
				Перший чек №: <?php echo $_SESSION['balance']['sale_id_first']; ?>
			</p>
			<p class="mainItemP">
				Д/Ч: <?php echo $_SESSION['balance']['sale_time_first']; ?>
			</p>
			<p class="mainItemP">
				Останній чек №: <?php echo $_SESSION['balance']['sale_id_last']; ?>
			</p>
			<p class="mainItemP">
				Д/Ч: <?php echo $_SESSION['balance']['sale_time_last']; ?>
			</p>
			<p class="mainItemP">
				Чеків: <?php echo $_SESSION['balance']['sale_checks']; ?>
			</p>
			<br>
			<p class="mainItemP">
				Готівкою: ................ <?php echo form($_SESSION['balance']['sale_received_cash']); ?> грн
			</p>
			<p class="mainItemP">
				Карткою: ................. <?php echo form($_SESSION['balance']['sale_received_card']); ?> грн
			</p>
			<p class="mainItemP">
				Решта: ..................... <?php echo form($_SESSION['balance']['sale_change']); ?> грн
			</p>
			<p class="mainItemP">
				СУМА ГОТІВКОЮ: .. <?php echo form($_SESSION['balance']['sale_sum_cash']); ?> грн
			</p>
			<p class="mainItemP">
				СУМА КАРТКОЮ: ... <?php echo form($_SESSION['balance']['sale_sum_card']); ?> грн
			</p>
			<p class="mainItemP">
				СУМА : ..................... <?php echo form($_SESSION['balance']['sale_sum']); ?> грн
			</p>
			<br>
			<p class="mainItemP">
				ОБІГ А: ..................... <?php echo form($_SESSION['balance']['sale_sum_a']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ Б: ..................... <?php echo form($_SESSION['balance']['sale_sum_b']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ В: ..................... <?php echo form($_SESSION['balance']['sale_sum_v']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ Г: ..................... <?php echo form($_SESSION['balance']['sale_sum_g']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ М: .................... <?php echo form($_SESSION['balance']['sale_sum_m']); ?> грн
			</p>
			<br>
			<p class="mainItemP">
				ПДВ А 20%: ............. <?php echo form($_SESSION['balance']['sale_sum_tax_a']); ?> грн
			</p>
			<p class="mainItemP">
				ПДВ Б 14%: ............. <?php echo form($_SESSION['balance']['sale_sum_tax_b']); ?> грн
			</p>
			<p class="mainItemP">
				ПДВ В 07%: ............. <?php echo form($_SESSION['balance']['sale_sum_tax_v']); ?> грн
			</p>
			<p class="mainItemP">
				ПДВ Г 00%: ............. <?php echo form($_SESSION['balance']['sale_sum_tax_g']); ?> грн
			</p>
			<p class="mainItemP">
				ЗБІР М 05%: ............ <?php echo form($_SESSION['balance']['sale_sum_tax_m']); ?> грн
			</p>
			<p class="mainItemP">
				ПОДАТОК: ............... <?php echo form($_SESSION['balance']['sale_sum_tax']); ?> грн
			</p>
		</div>
		<br>
		<div class="mainItem c<?php echo $_SESSION['balance']['return_checks']; ?>">
			<p class="mainItemP mainItemName">
				= = = = = = ПОВЕРНЕННЯ = = = = = =
			</p>
			<p class="mainItemP">
				Перший чек №: <?php echo $_SESSION['balance']['return_id_first']; ?>
			</p>
			<p class="mainItemP">
				Д/Ч: <?php echo $_SESSION['balance']['return_time_first']; ?>
			</p>
			<p class="mainItemP">
				Останній чек №: <?php echo $_SESSION['balance']['return_id_last']; ?>
			</p>
			<p class="mainItemP">
				Д/Ч: <?php echo $_SESSION['balance']['return_time_last']; ?>
			</p>
			<p class="mainItemP">
				Чеків: <?php echo $_SESSION['balance']['return_checks']; ?>
			</p>
			<br>
			<p class="mainItemP">
				Готівкою: ................ <?php echo form($_SESSION['balance']['return_received_cash']); ?> грн
			</p>
			<p class="mainItemP">
				Карткою: ................. <?php echo form($_SESSION['balance']['return_received_card']); ?> грн
			</p>
			<p class="mainItemP">
				Решта: ..................... <?php echo form($_SESSION['balance']['return_change']); ?> грн
			</p>
			<p class="mainItemP">
				СУМА ГОТІВКОЮ: .. <?php echo form($_SESSION['balance']['return_sum_cash']); ?> грн
			</p>
			<p class="mainItemP">
				СУМА КАРТКОЮ: ... <?php echo form($_SESSION['balance']['return_sum_card']); ?> грн
			</p>
			<p class="mainItemP">
				СУМА : ..................... <?php echo form($_SESSION['balance']['return_sum']); ?> грн
			</p>
			<br>
			<p class="mainItemP">
				ОБІГ А: ..................... <?php echo form($_SESSION['balance']['return_sum_a']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ Б: ..................... <?php echo form($_SESSION['balance']['return_sum_b']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ В: ..................... <?php echo form($_SESSION['balance']['return_sum_v']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ Г: ..................... <?php echo form($_SESSION['balance']['return_sum_g']); ?> грн
			</p>
			<p class="mainItemP">
				ОБІГ М: .................... <?php echo form($_SESSION['balance']['return_sum_m']); ?> грн
			</p>
			<br>
			<p class="mainItemP">
				ПДВ А 20%: ............. <?php echo form($_SESSION['balance']['return_sum_tax_a']); ?> грн
			</p>
			<p class="mainItemP">
				ПДВ Б 14%: ............. <?php echo form($_SESSION['balance']['return_sum_tax_b']); ?> грн
			</p>
			<p class="mainItemP">
				ПДВ В 07%: ............. <?php echo form($_SESSION['balance']['return_sum_tax_v']); ?> грн
			</p>
			<p class="mainItemP">
				ПДВ Г 00%: ............. <?php echo form($_SESSION['balance']['return_sum_tax_g']); ?> грн
			</p>
			<p class="mainItemP">
				ЗБІР М 05%: ............ <?php echo form($_SESSION['balance']['return_sum_tax_m']); ?> грн
			</p>
			<p class="mainItemP">
				ПОДАТОК: ............... <?php echo form($_SESSION['balance']['return_sum_tax']); ?> грн
			</p>
		</div>
	</section>
	<footer class="footer">
		<div class="footerSum">
			<p class="footerSumP">
				<?php echo 'ВСЬОГО: ' . form($_SESSION['balance']['sum']) . ' грн'; ?>
			</p>
		</div>
		<div class="footerNum">
			<p class="footerNumP">
				<?php echo 'З НИХ ГОТІВКОЮ: ... ' . form($_SESSION['balance']['sum_cash']) . ' грн'; ?>
			</p>
			<p class="footerNumP">
				<?php echo 'З НИХ КАРТКОЮ: .... ' . form($_SESSION['balance']['sum_card']) . ' грн'; ?>
			</p>
			<br>
			<p class="footerNumP">
				<?php echo 'ПОЧАТКОВИЙ ЗАЛИШОК: ... ' . form($_SESSION['balance']['balance_open']) . ' грн'; ?>
			</p>
			<p class="footerNumP">
				<?php echo 'СЛУЖБОВЕ ВНЕСЕННЯ: ....... ' . form($_SESSION['balance']['staff_in']) . ' грн'; ?>
			</p>
			<p class="footerNumP">
				<?php echo 'СЛУЖБОВЕ ВИЛУЧЕННЯ: .... ' . form($_SESSION['balance']['staff_out']) . ' грн'; ?>
			</p>
			<p class="footerNumP">
				<?php echo 'КІНЦЕВИЙ ЗАЛИШОК: .......... ' . form($_SESSION['balance']['balance_close']) . ' грн'; ?>
			</p>
			<?php if ($_SESSION['balance']['type'] == "Z") { ?>
				<br>
				<p class="footerNumP">
					<?php echo 'ФІСКАЛЬНИЙ ЗВІТ ДІЙСНИЙ'; ?>
				</p>
				<p class="footerNumP">
					<?php echo 'ДАНІ ЗАПИСАНІ ТА ПЕРЕДАНІ'; ?>
				</p>
				<p class="footerNumP">
					<?php echo 'РЕГІСТРИ ФІСК. ДАНИХ ОБНУЛЕНІ'; ?>
				</p>
			<?php } ?>
		</div>
		<?php if ($_SESSION['balance']['type'] == "Z") { ?>
			<div class="footerCode">
				<img src="/qr.php?data=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" alt="qr" class="footerCodeImg">
			</div>
		<?php } ?>
		<p class="footerFiskal"><?php
			if ($_SESSION['balance']['type'] == "Z" or $_SESSION['balance']['type'] == "ПЕРІОДИЧНИЙ<br>Z") {
				echo '= = = = = ФІСКАЛЬНИЙ ЧЕК = = = = =';
			} else {
				echo '= = = = = СЛУЖБОВИЙ ЧЕК = = = = =';
			}
		?></p>
		<p class="footerP">
			UNIKA Fiskal
		</p>
	</footer>
</body>
</html>