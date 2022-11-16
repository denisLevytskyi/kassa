<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php session_start(); echo $_SESSION['auth']['name']; ?> </title>
	<link rel="stylesheet" href="/Styles/unika.css">
</head>
<body>
	<header class="header">
		<div class="headerFirst">
			<a href="/" class="headerFirstA">
				<img src="/Materials/main_logo.png" class="headerFirstAImg">
			</a>
			<form action="/unika.php" class="headerFirstForm" method="GET">
				<input type="text" class="headerFirstFormInp" name="unika_add" placeholder="Article or Code" required>
				<button type="confirm" class="headerFirstFormBtn">+</button>
			</form>
			<div class="headerFirstSumm">
				<p class="headerFirstSumm">
					<?php echo ($_SESSION['unika']['summ']); ?>
				</p>
			</div>
		</div>
		<div class="headerSecond">
			<div class="headerSecondHead headerSecondHead1">
				<h2 class="headerSecondHeadH2">
					Name
				</h2>
			</div>
			<div class="headerSecondHead">
				<h2 class="headerSecondHeadH2">
					Price
				</h2>
			</div>
			<div class="headerSecondHead">
				<h2 class="headerSecondHeadH2">
					Amount
				</h2>
			</div>
			<div class="headerSecondHead">
				<h2 class="headerSecondHeadH2">
					Summ
				</h2>
			</div>
			<div class="headerSecondHead">
				<h2 class="headerSecondHeadH2">
					Dellet
				</h2>
			</div>
		</div>
	</header>
	<section class="list">
		<?php foreach ($_SESSION['unika']['list'] as $k => $v) { ?>
			<div class="listWrap">
				<div class="listWrapName">
					<img src="<?php echo ($v['foto']); ?>" class="listWrapNameImg">
					<p class="listWrapNameP">
						<?php echo ($v['article'] . ' ' . $v['name']); ?>
					</p>
				</div>
				<div class="listWrapElse">
					<?php echo ($v['price']); ?>
				</div>
				<div class="listWrapElse">
					<form action="/unika.php" class="listWrapElseForm" method="GET">
						<input type="text" class="listWrapElseFormInp" name="unika_amount_val" value="<?php echo ($v['amount']); ?>" required>
						<input type="text" style="display: none;" name="unika_amount_key" value="<?php echo ($k); ?>" required>
						<button type="confirm" style="display: none;">+</button>
					</form>
				</div>
				<div class="listWrapElse">
					<?php echo ($v['summ']); ?>
				</div>
				<div class="listWrapElse">
					<a href="/unika.php?unika_dell=<?php echo($k); ?>" class="listWrapElseA">
						DELLET
					</a>
				</div>
			</div>
		<?php } ?>
	</section>
	<footer class="footer">
		<form action="/unika.php" class="footerForm" method="GET">
			<div class="footerFormWrap">
				<input type="text" class="footerFormWrapInp" name="unika_cash" value="0.00" required>
				<p class="footerFormWrapP">Received</p>
			</div>
			<div class="footerFormWrap">
				<input type="radio" name="unika_pay" value="cash" checked>
				<p class="footerFormWrapP">CASH</p>
			</div>
			<div class="footerFormWrap">
				<input type="radio" name="unika_pay" value="card">
				<p class="footerFormWrapP">CARD</p>
			</div>
			<button type="confirm" class="footerFormBtn">PAY</button>
		</form>
	</footer>
</body>
</html>
