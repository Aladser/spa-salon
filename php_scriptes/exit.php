<?php
    session_start(); 
    $_SESSION['auth'] = null;
    $login = $_SESSION['login'];
    // подсчет числа входов-выходов текущего пользователя
    $_SESSION[$login.'IsExit'] = $_SESSION[$login.'IsExit'] ?? 0;
    $_SESSION[$login.'IsExit']++;
    header('Location: ../index.php');
?>