<?php
session_start();

if (!isset($_SESSION['user']) && $_SESSION['user']['login'] !== "admin") {
   header("Location: 404.php");
}
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
   <section class="admin">
      <div class="wrapper">

         <div class="tabs">
            <div class="tabs__nav tabs-nav">
               <div class="tabs-nav__item is-active" data-tab-name="tab-1">Додати товар</div>
               <div class="tabs-nav__item" data-tab-name="tab-2">Видалити товар</div>
               <div class="tabs-nav__item" data-tab-name="tab-3">Змінити товар</div>
            </div>
            <div class="tabs__content">
               <div class="tab is-active tab-1">
                  <form action="#" method="POST" enctype="multipart/form-data">
                     <label for="addNametovar">Назва товару</label>
                     <input type="text" placeholder="Введіть назву товару" id="addNametovar" name="title">
                     <label for="adddescrtovar">Опис товару</label>
                     <input type="text" placeholder="Введіть опис товару" id="adddescrtovar" name="description">
                     <label for="addpricetovar">Ціна товару без скидки</label>
                     <input type="number" placeholder="Введіть товар без скидки" id="addpricetovar" name="price">
                     <label for="addpricceDiscounttovar">Ціна товару з скидкою</label>
                     <input type="number" placeholder="Введіть ціну з скидкою" id="addpricceDiscounttovar" name="price_prev">
                     <label for="picturetovar">Завантажте фото з товаром</label>
                     <div class="file__input">
                        <input type="file" placeholder="Завантаже фото з товаром" id="picturetovar" name="picture" class="file">
                     </div>
                     <input type="submit" name="save" value="Зберегти" class="send">
                  </form>
                  <?php
                  if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['price_prev']) && isset($_POST['title']) && isset($_POST['save'])) {

                     $title = $_POST['title'];
                     $description = $_POST['description'];
                     $price = $_POST['price'];
                     $price_prev = $_POST['price_prev'];

                     $img = addslashes(file_get_contents($_FILES['picture']['tmp_name']));

                     mysqli_query($connection, "INSERT INTO `tovar` (`id`, `title`, `decsription`, `price`, `price_prev`, `picture`) VALUES (NULL, '$title', '$description', '$price', '$price_prev', '$img')");
                  }
                  ?>
               </div>
               <div class="tab tab-2">
                  <form action="#" method="POST">
                     <label for="removeNametovar">Виберіть із списка товар, який необхідно видалити</label>
                     <select name="deltovar" id="removeNametovar" name="title">
                        <?php
                        $sql = "SELECT id, title FROM `tovar`;";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                           echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                        }
                        ?>
                     </select>
                     <input type="submit" name="delete" value="Видалити" class="send">
                  </form>
                  <?php
                  if (isset($_POST['deltovar']) && isset($_POST['delete'])) {
                     $deltovar = $_POST['deltovar'];
                     $querydel = "DELETE FROM `tovar` WHERE `tovar`.`id` = '$deltovar'";
                     mysqli_query($connection, $querydel);
                  }

                  ?>
               </div>
               <div class="tab tab-3">
                  <form action="#" method="POST">
                     <label for="changeTovar">Виберіть із списка товар, який необхідно змінити</label>
                     <select name="changetov" id="changeTovar">
                        <?php
                        $sql = "SELECT * FROM `tovar`;";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                           echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                        }
                        ?>
                     </select>
                     <input type="submit" class="send" name="change" value="Пошук">
                  </form>


                  <?php
                  if (isset($_POST['change']) && isset($_POST['changetov'])) {
                     $changetovid  =  $_POST['changetov'];
                     $sqlquery = "SELECT * FROM `tovar` WHERE id = '$changetovid';";
                     $results = mysqli_query($connection, $sqlquery);
                     while ($row = mysqli_fetch_array($results)) {
                  ?>
                        <h2 class="change__tovar">Змініть товар</h2>
                        <form action="#" method="POST">
                           <label for="changeTitleTovar">Назва товару</label>
                           <input name="changetitletov" type="text" id="changeTitleTovar" value="<?= $row['title'] ?>">
                           <label for="changedescrTovar">Опис товару</label>
                           <input name="changedescrtov" type="text" id="changedescrTovar" value="<?= $row['decsription'] ?>">
                           <label for="changepriceTovar">Ціна товару</label>
                           <input name="changepricetov" type="number" id="changepriceTovar" value="<?= $row['price'] ?>">
                           <label for="changediscountTovar">Скидка</label>
                           <input name="changediscounttov" type="number" id="changediscountTovar" value="<?= $row['price_prev'] ?>">
                           <input type="number" name="idTovar" value="<?= $row['id'] ?>" class="hidden" disabled>
                           <input type="submit" name="changeIn" value="Змінити" class="send">
                        </form>
                  <?php }
                  }
                  if (isset($_POST['changeIn'])) {
                     $idTovar = $_POST['idTovar'];
                     $changeTitle  =  $_POST['changetitletov'];
                     $changeDescr  =  $_POST['changedescrtov'];
                     $changePrice  =  $_POST['changepricetov'];
                     $changeDiscount  =  $_POST['changediscounttov'];

                     $changeresult = "UPDATE `tovar` SET `title` = '$changeTitle', `decsription` = '$changeDescr', `price` = '$changePrice', `price_prev` = '$changeDiscount'  WHERE `id` = '$idTovar';";
                     mysqli_query($connection, $changeresult);
                  }
                  ?>
               </div>
            </div>
         </div>



      </div>
   </section>

   <script src="js/admin-tabs.js">
   </script>
</body>

</html>