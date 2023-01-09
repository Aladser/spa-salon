<?php
    include 'DBControl.php';
    $dbCtrl = new DBControl('../resources/users.data');
    session_start();
    
    $newLogin = $_POST['newLogin'];
    $newPassword = $_POST['newPassword'];

    if($dbCtrl->existsUser($newLogin)){ 
        $_SESSION['newLoginExists'] = $newLogin;
        $redirect = 'Location: ../pages/registrationWindow.php';
    }
    else {
        $dbCtrl->writeToDB($newLogin, $newPassword);
        $_SESSION['auth'] = true; // флаг аутентицикации
        $_SESSION['authTime'] = time(); // время авторизации
        $_SESSION['login'] = $newLogin;
        $redirect = 'Location: ../index.php';
    }

    // удаление переменной из сессии, если ранее сохранена в сессии
    if(!$dbCtrl->existsUser($newLogin) && isset($_SESSION['newLoginExists'])) unset($_SESSION['newLoginExists']);
    
    header($redirect);
?>