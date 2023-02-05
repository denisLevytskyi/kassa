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
	<title>CHECK: <?php session_start(); echo $_SESSION['check']['id']; ?></title>
	<link rel="stylesheet" href="/Styles/check.css">
</head>
<body>
	<header class="header">
		<a href="/unika.php" class="headerA">
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
				ЧЕК № <?php echo $_SESSION['check']['id']; ?>
			</p>
			<p class="headerInfoP">
				КАСИР: <?php echo $_SESSION['check']['auth_name']; ?>
				[<?php echo $_SESSION['check']['auth_id']; ?>]
			</p>
			<p class="headerInfoP">
				Д/Ч: <?php echo $_SESSION['check']['time']; ?>
			</p>
			<p class="headerInfoP">
				КАСА: <?php echo $_SESSION['check']['store_kass']; ?>
			</p>
			<p class="headerInfoP">
				Z-ЗВІТ: <?php echo $_SESSION['check']['z_id']; ?>
			</p>
		</div>
	</header>
	<section class="main">
		<?php foreach ($_SESSION['check']['main'] as $k => $v) { ?>
			<div class="mainItem">
				<p class="mainItemP">
					<?php echo form($v['price']) . ' X ' . $v['amount'] . ' = ' . form($v['sum']) . ' ' . $v['group']; ?>
				</p>
				<p class="mainItemP mainItemName">
					<?php echo $v['name']; ?>
				</p>
				<p class="mainItemP">
					<?php echo 'Ш/К: ' . $v['code']; ?>
				</p>
				<p class="mainItemP">
					<?php echo 'АРТИКУЛ: ' . $v['article']; ?>
				</p>
			</div>					
		<?php } ?>
	</section>
	<footer class="footer">
		<div class="footerSum">
			<p class="footerSumP">
				<?php echo 'ВСЬОГО: ' . form($_SESSION['check']['sum']) . ' грн'; ?>
			</p>
		</div>
		<div class="footerTax">
			<p class="footerTaxP c<?php echo $_SESSION['check']['sum_a']; ?>">
				<?php echo 'ОБІГ A: .... ' . form($_SESSION['check']['sum_a']) . ' ПДВ 20% = ' . form($_SESSION['check']['sum_tax_a']); ?>
			</p>
			<p class="footerTaxP c<?php echo $_SESSION['check']['sum_b']; ?>">
				<?php echo 'ОБІГ Б: .... ' . form($_SESSION['check']['sum_b']) . ' ПДВ 14% = ' . form($_SESSION['check']['sum_tax_b']); ?>
			</p>
			<p class="footerTaxP c<?php echo $_SESSION['check']['sum_v']; ?>">
				<?php echo 'ОБІГ В: .... ' . form($_SESSION['check']['sum_v']) . ' ПДВ 07% = ' . form($_SESSION['check']['sum_tax_v']); ?>
			</p>
			<p class="footerTaxP c<?php echo $_SESSION['check']['sum_g']; ?>">
				<?php echo 'ОБІГ Г: .... ' . form($_SESSION['check']['sum_g']) . ' ПДВ 00% = ' . form($_SESSION['check']['sum_tax_g']); ?>
			</p>
			<p class="footerTaxP c<?php echo $_SESSION['check']['sum_m']; ?>">
				<?php echo 'ОБІГ М: ... ' . form($_SESSION['check']['sum_m']) . ' Ак/З 05% = ' . form($_SESSION['check']['sum_tax_m']); ?>
			</p>
		</div>
		<br>
		<div class="footerNum">
			<p class="footerNumP c<?php echo $_SESSION['check']['received_cash']; ?>">
				<?php echo 'ГОТІВКИ: ........................ ' . form($_SESSION['check']['received_cash']) . ' грн'; ?>
			</p>
			<p class="footerNumP c<?php echo $_SESSION['check']['received_cash']; ?>">
				<?php echo 'РЕШТА: ........................... ' . form($_SESSION['check']['change']) . ' грн'; ?>
			</p>
			<p class="footerNumP">
				<?php echo 'ГОТІВКОЮ: ..................... ' . form($_SESSION['check']['sum_cash']) . ' грн'; ?>
			</p>
			<p class="footerNumP c<?php echo $_SESSION['check']['received_card']; ?>">
				<?php echo 'КАРТКОЮ: ...................... ' . form($_SESSION['check']['sum_card']) . ' грн'; ?>
			</p>
		</div>
		<div class="footerCode">
			<img src="/qr.php?data=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" alt="qr" class="footerCodeImg">
		</div>
		<p class="footerFiskal">
			= = = = = <?php echo $_SESSION['check']['type']; ?> = = = = =
		</p>
		<p class="footerP">
			UNIKA Fiskal
		</p>
	</footer>
</body>
</html>