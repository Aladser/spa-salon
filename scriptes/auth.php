<?php
    include 'db.php';
    session_start();

    // логин пароль одинаковые для простоты
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    // переходы на другие сайты
    if(existsUser($login)){
        if(checkPassword($login, $password)){
            $_SESSION['auth'] = true; // флаг аутентицикации
            $_SESSION[$login]['visit'] = $_SESSION[$login]['visit'] ?? 0; // число посещений сайта(index.php) текущего пользователя
            $_SESSION['authTime'] = time(); // время авторизации
        }     
        else{
            $_SESSION['wrongpassword'] = true; // флаг неправильного пароля
        }
    } 
    else{
        $_SESSION['nouser'] = true; // флаг несуществующего пользователя
    }

    $_SESSION['login'] = $login;
    header('Location: ../index.php');
?>