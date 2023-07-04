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
	<title>
		<?php session_start(); echo form($_SESSION['unika']['sum'])	. ' | ' . $_SESSION['auth']['name']; ?>
	</title>
	<link rel="stylesheet" href="/Styles/unika.css">
</head>
<body>
	<header class="header">
		<div class="headerFirst">
			<a href="/" class="headerFirstA">
				<img src="/Materials/main_logo.png" class="headerFirstAImg">
			</a>
			<form action="/unika.php" class="headerFirstForm" method="POST">
				<input autofocus type="text" class="headerFirstFormInp" name="unika_add" placeholder="Article or Code" required>
				<button type="submit" class="headerFirstFormBtn">+</button>
			</form>
			<div class="headerFirstSum">
				<p class="headerFirstSumP">
					<?php echo form($_SESSION['unika']['sum']); ?>
				</p>
			</div>
		</div>
		<div class="headerSecond">
			<div class="headerSecondHead headerSecondHead1">
				<h2 class="headerSecondHeadH2">
					№
				</h2>
			</div>
			<div class="headerSecondHead headerSecondHead2">
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
					Sum
				</h2>
			</div>
			<div class="headerSecondHead">
				<h2 class="headerSecondHeadH2">
					Delete
				</h2>
			</div>
		</div>
	</header>
	<section class="list">
		<?php foreach ($_SESSION['unika']['list'] as $k => $v) {
			$type = null;
			if ($v['group'] == 'М+А') {
				$type = 'excise';
			}
			if (isset($v['delete']) and $v['delete']) {
				$type = 'delete';
			}?>
			<div class="listWrap <?php echo $type; ?>">
				<div class="listWrapFirst">
					<?php echo $k + 1; ?>
				</div>
				<div class="listWrapName">
					<img src="<?php echo $v['photo']; ?>" class="listWrapNameImg">
					<p class="listWrapNameP">
						<?php echo $v['article'] . ' ' . $v['name']; ?>
					</p>
				</div>
				<div class="listWrapElse">
					<?php echo form($v['price']); ?>
				</div>
				<div class="listWrapElse">
					<form action="/unika.php" class="listWrapElseForm" method="POST">
						<input type="text" class="listWrapElseFormInp" name="unika_amount_val" value="<?php echo $v['amount']; ?>" required>
						<input type="text" style="display: none;" name="unika_amount_key" value="<?php echo $k; ?>" required>
						<button type="submit" style="display: none;">+</button>
					</form>
				</div>
				<div class="listWrapElse">
					<?php echo form($v['sum']); ?>
				</div>
				<div class="listWrapElse">
					<a href="/unika.php?unika_del=<?php echo $k; ?>" class="listWrapElseA">
						DELETE
					</a>
				</div>
			</div>
		<?php } ?>
	</section>
	<footer class="footer">
		<form action="/unika.php" class="footerForm" method="POST">
			<div class="footerFormWrap">
				<input type="text" class="footerFormWrapInp" name="unika_cash" value="0" required>
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
			<div class="footerFormWrap">
				<input type="checkbox" name="unika_return">
				<p class="footerFormWrapP">RETURN</p>
			</div>
			<div class="footerFormWrap">
				<input type="checkbox" name="unika_null">
				<p class="footerFormWrapP">NULL</p>
			</div>
			<button type="submit" class="footerFormBtn">PAY</button>
		</form>
	</footer>
</body>
</html>