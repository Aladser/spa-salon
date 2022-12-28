<?php
    include 'db.php';
    session_start();

    // логин пароль одинаковые
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    // переходы на другие сайты
    if(existsUser($login)){
        if(checkPassword($login, $password)){
            $_SESSION['auth'] = true; // флаг аутентицикации
            $_SESSION['login'] = $login; // текущий пользователь
            $_SESSION[$login] = $_SESSION[$login] ?? 0; // число посещений сайта(index.php) текущего пользователя
            $time = explode(':', date('G:i'));
            $_SESSION['startHours'] = $time[0]; // часы входа
            $_SESSION['startMinutes'] =  $time[1]; // минуты входа

            header('Location: ../index.php');
        }     
        else{
            $_SESSION['wrongpassword'] = true; // флаг неправильного пароля
            $_SESSION['login'] = $login;

            header('Location: ../pages/login.php');
        }
    } 
    else{
        $_SESSION['nouser'] = true; // флаг несуществующего пользователя
        
        header('Location: ../pages/login.php');
    }
?>