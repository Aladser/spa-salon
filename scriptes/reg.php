<?php
    include 'db.php';
    session_start();
    
    $newLogin = $_POST['newLogin'];
    $newPassword = $_POST['newPassword'];

    // если пользователь существует
    if(existsUser($newLogin)) 
        $_SESSION['newLoginExists'] = $newLogin;
    // удаление переменной из сессии 
    else if(isset($_SESSION['newLoginExists'])) 
        unset($_SESSION['newLoginExists']);
    
    header('Location: ../pages/registrationWindow.php');
?>