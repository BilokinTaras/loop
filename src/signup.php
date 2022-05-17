<?php

session_start();
require_once 'db.php';

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$check_login = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$login'");
if (mysqli_num_rows($check_login) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Такой логин уже существует",
        "fields" => ['login']
    ];

    echo json_encode($response);
    die();
}

$error_fields = [];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'password';
}

if ($full_name === '') {
    $error_fields[] = 'full_name';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}

if ($password_confirm === '') {
    $error_fields[] = 'password_confirm';
}


if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}

if ($password === $password_confirm) {

    $password = md5($password);

    mysqli_query($connection, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES (NULL, '$full_name', '$login', '$email', '$password')");

    $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "message" => "Пароли не совпадают",
    ];
    echo json_encode($response);
}
