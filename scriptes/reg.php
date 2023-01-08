<?php
    include 'db.php';
    session_start();
    $newLogin = $_POST['newLogin'];
    $newPassword = $_POST['newPassword'];

    if(existsUser($newLogin)) $_SESSION['newLoginExists'] = $newLogin;
    else writeToDB($newLogin, $newPassword);

    // удаление переменной из сессии, если третья регистрация существующего пользователя 
    if(!existsUser($newLogin) && isset($_SESSION['newLoginExists'])) unset($_SESSION['newLoginExists']);
    
    header('Location: ../pages/registrationWindow.php');
?>