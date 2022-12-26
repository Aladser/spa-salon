<?php
    include 'db.php';
    session_start();

    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;
    
    // переход на другой сайт
    function redirect($param){
        switch($param){
            case 'auth':
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $login;
                header('Location: index.php');
                exit;
            case 'nouser':
                $_SESSION['nouser'] = true;
                header('Location: login.php');
                exit;
            case 'wrongpassword':
                $_SESSION['wrongpassword'] = true;
                header('Location: login.php');
                exit;
        }
    }

    if(existsUser($login)){
        if(checkPassword($login, $password)) redirect('auth'); // логин и пароль верны      
        else redirect('wrongpassword'); // неверный пароль
    } 
    else 
        redirect('nouser'); // пользователь не существует
?>