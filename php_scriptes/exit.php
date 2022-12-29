<?php
    session_start(); 
    $_SESSION['auth'] = null;
    $login = $_SESSION['login'];
    $_SESSION[$login.'Exit'] = $_SESSION[$login.'Exit'] ?? 0;
    $_SESSION[$login.'Exit']++;
    header('Location: ../index.php');
?>