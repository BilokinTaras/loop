<?php
session_start();

if ($_SESSION['user']) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Форма регістрації</title>
</head>

<body>
    <main>
        <div class="circle"></div>
        <div class="register-form-container">
            <form action="">
                <h1 class="form-title">
                    Реєстрація
                </h1>

                <div class="form-fields">
                    <div class="form-field">
                        <input type="text" name="full_name" placeholder="Введіть повне імя">
                    </div>
                    <div class="form-field">
                        <input type="text" name="login" placeholder="Введіть свій логін" required>
                    </div>
                    <div class="form-field">
                        <input type="email" name="email" placeholder="Пошта" required>
                    </div>
                    <div class="form-field">
                        <input type="password" name="password" placeholder="Пароль" required minlength="8" maxlength="128">
                    </div>
                    <div class="form-field">
                        <input type="password" name="password_confirm" placeholder="Підтвердіть Пароль" required minlength="8" maxlength="128">
                    </div>
                </div>
                <div class="form-buttons">
                    <button class="button register-btn" type="submit">Зареєструватися</button>
                    <a href="login.php">Увійти</a>
                    <span>якщо є обліковий запис</span>
                </div>
            </form>
        </div>
    </main>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>