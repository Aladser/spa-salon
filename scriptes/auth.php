<?php
    include 'db.php';
    session_start();

    // логин пароль одинаковые для простоты
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;
    $indexPage = 'Location: ../index.php';
    $loginPage = 'Location: ../pages/login.php';

    // переходы на другие сайты
    if(existsUser($login)){
        if(checkPassword($login, $password)){
            $_SESSION['auth'] = true; // флаг аутентицикации
            $_SESSION[$login]['visits'] = $_SESSION[$login]['visits'] ?? 0; // число посещений сайта(index.php) текущего пользователя
            $_SESSION['authTime'] = time(); // время авторизации
        }     
        else $_SESSION['wrongpassword'] = true; // флаг неправильного пароля
    } 
    else $_SESSION['nouser'] = true; // флаг несуществующего пользователя

    $_SESSION['login'] = $login;
    $page = isset($_SESSION['wrongpassword']) || isset($_SESSION['nouser']) ? $loginPage : $indexPage;
    header($page);
?>