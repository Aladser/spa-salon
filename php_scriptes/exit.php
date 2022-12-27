<?php
    // уничтожение сессии
    session_start();
    $login = $_SESSION['login'];
    $_SESSION = array();
    session_destroy();
    
    // создание новой сессии
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['count'] = 0;
    
    header('Location: ../index.php');
?>