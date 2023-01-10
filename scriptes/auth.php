<?php
    include 'DBControl.php';
    session_start();

    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    // переходы на другие сайты
    if($dbCtrl->existsUser($login)){
        if($dbCtrl->checkPassword($login, $password)){
            $_SESSION['auth'] = true; // флаг аутентицикации
            $_SESSION['authTime'] = time(); // время авторизации
        }     
        else $_SESSION['wrongpassword'] = true; // флаг неправильного пароля
    } 
    else $_SESSION['nouser'] = true; // флаг несуществующего пользователя

    $_SESSION['login'] = $login;
    header('Location: ../index.php');
?>