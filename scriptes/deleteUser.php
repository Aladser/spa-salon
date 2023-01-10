<?php
    include 'DBControl.php';
    session_start();

    $remuser = explode('=', $_SERVER['REQUEST_URI'])[1]; // строка параметров
    $dbCtrl->removeUser($remuser);
    unset($_SESSION[$remuser]);
    
    header('Location: ../pages/admin.php');
?>