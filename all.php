<?php
session_start();



require_once "db.php";
require_once "functions.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
   <section class="all">
      <div class="wrapper">
         <div class="filter-top">
            <div class="btn-hidden">Сховати фільтри</div>
            <div class="filter-category">
               <span>Сортування</span>
               <select name="select-category" class="filter-select">
                  <option value="value1" selected>Новинки</option>
                  <option value="value2">Скидки</option>
               </select>
            </div>
            <div class="filter-show">
               <span>Показати</span>
               <input type="number" min="1" max="10">
            </div>
         </div>
         <div class="filter-result">
            <div class="filter-left">
               <div class="filter__name">
                  <div class="tovar">
                     Товари
                  </div>
               </div>
               <input class="filter__search" type="text" placeholder="Пошук за назвою">
               <div class="filter__name">
                  <div class="price">
                     Ціна
                  </div>
               </div>
               <div class="filter__price">
                  <span>Від</span>
                  <input type="number" min="1">
                  <span>До</span>
                  <input type="number" min="2">
               </div>
            </div>
            <div class="filter-tovar">
               <div class="product">
                  <?php $data_to_current_table = ViewNewsTovar();
                  foreach ($data_to_current_table as $course_item) :
                     $showimg = base64_encode($course_item['picture']);
                  ?>


                     <div class="product-item">
                        <div class="product-picture">
                           <img src="data:image/jpeg;base64, <?= $showimg ?>" alt="Product">
                        </div>
                        <p class="product-title"><?= $course_item['name'] ?></p>
                        <p class="product-price"><?php echo $course_item['price'] ?> грн</p>

                        <a href="single.php?id=<?php echo $course_item['id'] ?>" class="product-more">
                           Детальніше
                        </a>

                        <a href="cart.php?course_id=<?php echo $course_item['id'] ?>" class="product-cart">
                           В кошик
                        </a>
                     </div>

                  <?php endforeach; ?>
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
   <script src="js/filter.js"></script>
</body>

</html>