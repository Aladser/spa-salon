<?php
    session_start();
    $_SESSION['loginClick'] = true;
    header('Location: ../index.php');
?>