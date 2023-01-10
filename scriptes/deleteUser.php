<?php
    include 'DBControl.php';
    session_start();

    $remuser = explode('=', $_SERVER['REQUEST_URI'])[1];
    $dbCtrl->removeUser($remuser);
    
    header('Location: ../pages/admin.php');
?>