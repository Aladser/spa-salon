<?php
    include 'DBControl.php';
    session_start();
    
    $newLogin = $_POST['newLogin'];
    $newPassword = $_POST['newPassword'];

    if(DBControl::existsUser($newLogin)){ 
        $_SESSION['newLoginExists'] = $newLogin;
        $redirect = 'Location: ../pages/registrationWindow.php';
    }
    else {
        DBControl::writeToDB($newLogin, $newPassword);
        $_SESSION['auth'] = true; // флаг аутентицикации
        $_SESSION['authTime'] = time(); // время авторизации
        $_SESSION['login'] = $newLogin;
        $redirect = 'Location: ../index.php';
    }

    // удаление переменной из сессии, если ранее сохранена в сессии
    if(!DBControl::existsUser($newLogin) && isset($_SESSION['newLoginExists'])) unset($_SESSION['newLoginExists']);
    
    header($redirect);
?>