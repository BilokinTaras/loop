<?php
session_start();

require_once "db.php";
require_once "functions.php";
global $connection;
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP();                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;               // Enable SMTP authentication
$mail->Username = 'taryknyga@gmail.com';   // SMTP username
$mail->Password = '15102003taras';   // SMTP password
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                    // TCP port to connect to



$mailusers =  $_SESSION['user']['email'];
// Sender info
$mail->setFrom('taryknyga@gmail.com', 'FromName');
$mail->addReplyTo('' . $mailusers, 'ReplyName');

// Add a recipient
$mail->addAddress('' . $mailusers);

//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

// Set email format to HTML
$mail->isHTML(true);

// Mail subject
$mail->Subject = 'Email from local host to test';

// Mail body content
$mainsum = 0;

$bodyContent = '<h1>Вас вітає магазин LOOP</h1>';
$bodyContent .= '<p>Ви замовляли</p>';
$bodyContent .= '<ol>';


if (isset($_SESSION['cart_list'])) {
   foreach ($_SESSION['cart_list'] as $item) {
      $bodyContent .= '<li> ' . $item['title']  . ' . ' . $item['price'] . '</li>';
      $mainsum = $mainsum + $item['price'];
   }
}

$bodyContent .= '</ol>';
$bodyContent .= 'Всього: ' . $mainsum . '<br>';
$bodyContent .= 'Дякую за замовлення, очікуйте з вами звяжеться менеджер!';

$mail->Body    = $bodyContent;

if (isset($_SESSION['cart_list'])) {
   $mainsum = 0;
   foreach ($_SESSION['cart_list'] as $item) {
      $orderDB .= 'Назва товару -- ' . $item['title'] . 'Ціна товару -- ' . $item['price'];
      $mainsum = $mainsum + $item['price'];
   }
}
$query = "INSERT INTO `orders` (`id`, `order`, `price`) VALUES (NULL, '$orderDB', '$mainsum');";

mysqli_query($connection, $query);





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
   <div class="email">
      <?php
      // Send email 
      if (!$mail->send()) {
         echo '<img src="img/cancel.png" class="cancel">';
         echo '<h1 class="order_delete">Замовлення не відправлено</h1>';
         echo '<a href="index.php" class="page__return">Повернутися</a>';
      } else {
         echo '<img src="img/done.png" class="done">';
         echo '<h1 class="order_hold">Дякую за замовлення</h1>';
         echo '<a href="index.php" class="page__return">Повернутися</a>';
      } ?>

   </div>

</body>

</html>