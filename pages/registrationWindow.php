<!DOCTYPE html>
<html lang="en">

<?php 
    session_start();
    $newUserExists = isset($_SESSION['newLoginExists']) ? 'true':'false';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/registration.css">
    <title>Регистрация пользователя</title>
</head>

<body>
<main>
    <form class='newUserForm' method="POST" action='../scriptes/reg.php'>
        <h3 class='newUserForm__header'>Регистрация нового пользователя</h3>
        <div class='newUserForm__row'><p class='newUserForm__label'>Логин:</p><input type="text" name='newLogin'></div>
        <div class='newUserForm__row'><p class='newUserForm__label'>Пароль:</p><input type="password" name='newPassword'></div>
        <div class='newUserForm__row newUserForm__btnrow'>
            <input type="submit" class='newUserForm__btn newUserForm__regBtn' value="Регистрация">
            <input type="button" class='newUserForm__btn newUserForm__backBtn' id='newPassword__backBtn' value="Назад">
        </div>
        <p class='newUserForm__error'><?=$newUserExists?></p>
    </form>
</main>
<script type='text/javascript' src='../js/registration.js'></script>
</body>
</html>