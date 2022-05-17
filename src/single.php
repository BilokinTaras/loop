<?php
session_start();

require_once "db.php";
require_once "functions.php";

if (isset($_GET['id'])) {
	$query = "SELECT * FROM tovar WHERE id=" . $_GET['id'];

	$req = mysqli_query($connection, $query);
	$current_tovar = mysqli_fetch_assoc($req);


	if (empty($current_tovar)) {
		header("Location: 404.php");
	}
}

?>


<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="page-light">
		<div class="wrapper">
			<header class="header">
				<nav>
					<ul class="nav">
						<li class="nav-item"><a class="nav-link" href="">Для чоловіків</a></li>
						<li class="nav-item"><a class="nav-link" href="">Для жінок</a></li>
						<li class="nav-item"><a class="nav-link" href="">Для дітей</a></li>
					</ul>
				</nav>
				<img class="header-logo" src="img/logo.svg" alt="Logo">
				<ul class="nav nav-info">
					<li class="nav-item"><a class="nav-link" href="">Оплата</a></li>
					<li class="nav-item"><a class="nav-link" href="">Доставка</a></li>
				</ul>
				<button class="cart">
					<span class="cart-count">
						<?php
						if (isset($_SESSION['cart_list'])) {
							echo count($_SESSION['cart_list']);
						}
						?>
					</span>
				</button>
				<div class="toggle-menu">
					<div class="line line1"></div>
					<div class="line line2"></div>
					<div class="line line3"></div>
				</div>

			</header>
		</div>
	</div>
	<section class="info">
		<div class="wrapper">
			<div class="info__title">
				<?= $current_tovar['title'] ?>
			</div>
			<div class="tabs">
				<div class="tabs__nav tabs-nav">
					<div class="tabs-nav__item is-active" data-tab-name="tab-1">Загальна інформація</div>
					<div class="tabs-nav__item" data-tab-name="tab-2">Деталі товару</div>
				</div>
				<div class="tabs__content">
					<div class="tab is-active tab-1">
						<div class="tovar">
							<div class="tovar__picture">
								<?php
								$showimg = base64_encode($current_tovar['picture']);
								?>

								<img src="data:image/jpeg;base64, <?= $showimg ?>" alt="img">
							</div>
							<div class="tovar__content">
								<div class="tovar__information">
									<div class="tovar__price">
										<span class="price__now"><?php echo $current_tovar['price'] ?>грн</span>
										<?php
										if ($current_tovar['price_prev'] > 0 && $current_tovar['counts'] > 0) {
										?>
											<span class="price__prev"><?= $current_tovar['price_prev'] ?></span>
										<?
										} else {
											echo '';
										}
										?>

									</div>
								</div>
								<div class="tovar__color">
									<div class="color__name">Колір</div>
									<div class="color__content">
										<div class="color__item"></div>
										<div class="color__item"></div>
										<div class="color__item"></div>
									</div>
								</div>
								<div class="order">
									<form method="POST" action="cart.php?course_id=<?= $current_tovar['id'] ?>" class="order__cart">
										<a href="cart.php?course_id=<?= $current_tovar['id'] ?>" class="order__link">
											<input type="submit" value="Додати до корзини" class="order__add">
										</a>
									</form>
								</div>
								<div class="pay">
									<img src="img/visa.png" alt="" class="pay__item">
									<img src="img/master-card.png" alt="" class="pay__item">
									<img src="img/pay-pal.png" alt="" class="pay__item">
								</div>
							</div>
						</div>
					</div>
					<div class="tab tab-2">
						<div class="tovar__descr"><?php echo $current_tovar['decsription'] ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="page-dark">
		<div class="wrapper">
			<footer class="footer">
				<div class="footer-logo">
					<img src="img/logo-footer.svg" alt="Logo">
					<div class="footer-content">
						Особисті заняття багатьма видами спорту, тренерську діяльність, професійне навчання в Університеті фізкультури та спорту, створення та підтримку спортивної громадської організації.
					</div>
				</div>
				<div class="footer-nav">
					<ul class="footer-list">
						<li class="footer-list-item footer-list-title">Основні посилання</li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Про компанію</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Каталог</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Доставка</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Оплата</a></li>
					</ul>
					<ul class="footer-list">
						<li class="footer-list-item footer-list-title">Категорії</li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Чоловічі браслети</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Жіночі браслети</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Дитячі браслети</a></li>
					</ul>
					<ul class="footer-list">
						<li class="footer-list-item footer-list-title">Корисні посилання</li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Таблиця розмірів</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Блог</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Наша місія</a></li>
					</ul>
					<ul class="footer-list">
						<li class="footer-list-item footer-list-title">КОЛЛ ЦЕНТР</li>
						<li class="footer-list-item"><a class="footer-list-link" href="">Пн-пт: 09.00-18.30</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">(044) 585-7-333</a></li>
						<li class="footer-list-item"><a class="footer-list-link" href="">(096) 585-7-333</a></li>
					</ul>
				</div>
			</footer>
		</div>
	</div>
	<div class="wrapper">
		<div class="footer-bottom">
			<p class="footer-bottom-copyright">Copyright © 2021. Всі права захищені</p>
			<a href="#" class="footer-bottom-link">Розробник Bilokin Taras</a>
		</div>
	</div>
	<div class="nav-bar">
		<ul class="nav-list">
			<li class="nav-list-item"><a href="" class="nav-link">Для Чоловіків</a></li>
			<li class="nav-list-item"><a href="" class="nav-link">Для жінок</a></li>
			<li class="nav-list-item"><a href="" class="nav-link">Для дітей</a></li>
			<li class="nav-list-item"><a href="" class="nav-link">Оплата</a></li>
			<li class="nav-list-item"><a href="" class="nav-link">Доставка</a></li>
		</ul>
	</div>
	<script>
		var toggleButton = document.querySelector('.toggle-menu');
		var navBar = document.querySelector('.nav-bar');
		toggleButton.addEventListener('click', function() {
			navBar.classList.toggle('toggle');
		});
	</script>
	<script src="js/script.js"></script>
</body>

</html>