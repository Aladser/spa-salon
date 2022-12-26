<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    // аутентификация
    $auth = $_SESSION['auth'] ?? null;
    if (!$auth) {
        header('Location: login.php');
        exit;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title> СПА-салон </title>
</head>
<body>
    <footer class='footer'>
        <div class='user'><?php 
        if($auth){
            $login = $_SESSION['login'];
            echo "Здравствуйте, $login!";
        } 
        ?></div>
    </footer>
    <main>
    Главная страница
    </main>
</body>
</html>