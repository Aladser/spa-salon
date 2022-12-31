<?php
    session_start(); 
    $_SESSION['auth'] = null;
    $login = $_SESSION['login'];
    // подсчет числа входов-выходов текущего пользователя
    $_SESSION[$login]['exit'] = $_SESSION[$login]['exit'] ?? 0;
    $_SESSION[$login]['exit']++;
    header('Location: ../index.php');
?>