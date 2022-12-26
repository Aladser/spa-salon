<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    
    $count = $_SESSION['count'] ?? 0;
    $_SESSION['count'] = ++$count;

    // аутентификация
    $auth = $_SESSION['auth'] ?? null;
    if (!$auth) header('Location: pages/login.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title> СПА-салон </title>
</head>

<body>

    <footer class='footer'>
        <!--  отображение имени пользователя 
            не используется getCurrentUser(), чтобы не подключать db.php
        -->
        <p class='user'><?php 
        if($auth){
            $login = $_SESSION['login'];
            $startHours = $_SESSION['startHours'];
            $startMinutes = $_SESSION['startMinutes'];

            echo "$login (с $startHours:$startMinutes GMT+3)";
        } 
        ?></p>
        <!-- Выход из личного кабинета -->
        <form class='form-exit' method="POST" action='../php_scriptes/exit.php'>
            <input class='btn-exit' type="submit" value='Выйти'>
        </form>
        <!-- Отображение скидки -->
        <p class='discount'><?php
            if($auth){
                $time = explode(':', date('G:i'));
                $nowHours = 23 - $time[0];
                $nowMinutes = 60 - $time[1];

                echo "Для вас индивидуальное предложение! Спешите!  Осталось ";
                echo $nowHours != 0 ? "$nowHours ч. $nowMinutes мин." : "$nowMinutes мин.";
            }
        ?></p>
    </footer>

    <main>
    Главная страница
    </main>
    
</body>
</html>