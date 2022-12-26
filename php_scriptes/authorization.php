<?php
    include 'db.php';
    session_start();

    // логин пароль одинаковые
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    // переходы на другие сайты
    if(existsUser($login)){
        if(checkPassword($login, $password)){
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            $time = explode(':', date('G:i'));
            $_SESSION['startHours'] = $time[0];
            $_SESSION['startMinutes'] =  $time[1];

            header('Location: ../index.php');
        }     
        else{
            $_SESSION['wrongpassword'] = true;
            $_SESSION['login'] = $login;

            header('Location: ../pages/login.php');
        }
    } 
    else{
        $_SESSION['nouser'] = true;
        
        header('Location: ../pages/login.php');
    }
?>