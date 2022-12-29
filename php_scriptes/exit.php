<?php
    session_start(); 
    $_SESSION['auth'] = null;
    $login = $_SESSION['login'];
    $_SESSION[$login] = null;
    
    $_SESSION[$login.'IsExit'] = $_SESSION[$login.'IsExit'] ?? true;
    header('Location: ../index.php');
?>