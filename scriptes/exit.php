<?php
    session_start();
    unset($_SESSION['auth']); 
    unset($_SESSION['authTime']);
    $login = $_SESSION['login'];
    unset($_SESSION['login']);
    $_SESSION[$login]['exit']++;
    header('Location: ../index.php');
?>