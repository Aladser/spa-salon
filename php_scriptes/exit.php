<?php
    // уничтожение сессии
    session_start();
    $login = $_SESSION['login'];
    $_SESSION = array();
    session_destroy();
    
    // создание новой сессии
    session_start();
    $_SESSION['exit'] = true;
    $_SESSION['login'] = $login;
    
    header('Location: ../pages/login.php');
?>