<?php
    session_start();
    unset($_SESSION['auth']); 
    unset($_SESSION['authTime']);
    $login = $_SESSION['login'];
    unset($_SESSION['login']);
    // подсчет числа выходов текущего пользователя
    $_SESSION[$login]['exit'] = $_SESSION[$login]['exit'] ?? 0;
    $_SESSION[$login]['exit']++;
    header('Location: ../index.php');
?>