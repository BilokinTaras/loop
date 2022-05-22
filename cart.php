<?php
session_start();


require_once "db.php";
require_once "functions.php";

if (!$_SESSION['user']) {
	header("Location: index.php");
}

if (isset($_GET['delete_id']) && isset($_SESSION['cart_list'])) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ($value['id'] == $_GET['delete_id']) {
			unset($_SESSION['cart_list'][$key]);
		}
	}
}

if (isset($_GET['delete_id']) && isset($_SESSION['cart_list'])) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ($value['id'] == $_GET['delete_id']) {
			unset($_SESSION['cart_list'][$key]);
		}
	}
}


if (isset($_GET['course_id']) && !empty($_GET['course_id'])) {

	$current_added_course = get_course_by_id($_GET['course_id']);

	if (!empty($current_added_course)) {

		if (!isset($_SESSION['cart_list'])) {
			$_SESSION['cart_list'][] = $current_added_course;
		}


		$course_check = false;

		if (isset($_SESSION['cart_list'])) {
			foreach ($_SESSION['cart_list'] as $value) {
				if ($value['id'] == $current_added_course['id']) {
					$course_check = true;
				}
			}
		}


		if (!$course_check) {
			$_SESSION['cart_list'][] = $current_added_course;
		}
	} else {
		header("Location: 404.php");
	}
}


?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Cart</title>
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

	<div class="cart__title">
		Корзина замовлень
	</div>
	<form method="POST" action="email.php" class="cart__content">
		<?php if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) != 0) :
		?>

			<?php foreach ($_SESSION['cart_list'] as $course) :

				$showimg = base64_encode($course['picture']);
			?>


				<div class="cart__item">
					<img src="data:image/jpeg;base64, <?= $showimg ?>" alt="Product">
					<a href="single.php?id=<?= $course['id'] ?>" class="cart__name"><?= $course['title']; ?></a>
					<a href="cart.php?delete_id=<?php echo $course['id']; ?>" class="cart__remove">Видалити</a>
					<div class="cart__price"><?php echo $course['price']; ?>грн</div>
				</div>

			<?php $count__tovar = $count__tovar + $course['price'];

			endforeach; ?>
			<div class="cart__general">
				<div class="total">Всього: <?= $count__tovar ?></div>
				<input type="submit" href="#" class="confirm" value="Підтвердити">
			</div>
		<?php else : ?>

			<p class="cart__none">
				Ваша корзина пуста
			</p>

		<?php endif; ?>
	</form>

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