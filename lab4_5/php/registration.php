<?php
$name = strip_tags($_POST["name"]);
$surname = strip_tags($_POST["surname"]);
$login=strip_tags($_POST["login"]);
$password=strip_tags($_POST["password"]);
if (strlen($name)>15 || preg_match('[0-9]', $name)){
    echo '<script> alert("Ошибка в поле имени")</script>';
} else {
    echo '<script> alert("Имя прошло")</script>';
}

if (strlen($surname)>15 || preg_match('[0-9]', $surname)){
        echo '<script> alert("Ошибка в поле фамилии")</script>';
} else {
    echo '<script> alert("Фамилия прошло")</script>';
}

if (strlen($login)>15 || preg_match('[0-9]', $login)) {
    echo '<script> alert("Ошибка в поле логина")</script>';
} else {
    echo '<script> alert("Логин прошло")</script>';
}

if (strlen($password)>15 || !preg_match('[0-9]', $password)){
    echo '<script> alert("Ошибка в поле пароля")</script>';
} else {
    echo '<script> alert("Пароль прошло")</script>';
    header("Location: home.php");
}