<?php

    include 'db.php';
    session_start();

    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    // переходы на другие сайты
    if(existsUser($login)){
        if(checkPassword($login, $password)){
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            header('Location: index.php');
        }     
        else{
            $_SESSION['wrongpassword'] = true;
            header('Location: login.php');
        }
    } 
    else{
        $_SESSION['nouser'] = true;
        header('Location: login.php');
    }
    exit;
?>