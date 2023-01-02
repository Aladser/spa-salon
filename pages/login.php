<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/login.css">
    <title> СПА-салон: авторизация </title>
</head>
<body>
    <div class='loginWindow'><form method="POST" action='../scriptes/auth.php'>
        <h3 class='loginWindow__header'> Авторизация</h3>

        <?php
            session_start();
            // вывод сообщения о неправильном логине или пароле
            $nouser = $_SESSION['nouser'] ?? null;
            $wrongPassword = $_SESSION['wrongpassword'] ?? null;
            if($nouser){
                echo "<div class='loginWindow__error'>Пользователь не существует</div>";
                unset($_SESSION['nouser']);
            }
            elseif($wrongPassword)
                echo "<div class='loginWindow__error'>Неверный пароль</div>";      
        ?>

        <div class='loginWindow__formRow'>
            <label for="loginInput" class='loginWindow__label'>Логин:</label>
            <input type='text' class='loginWindow__input' name='login' id='loginInput' autocomplete='on' value = <?= $wrongPassword || $nouser ? $_SESSION['login'] : 'antonova_da' ?> >
            <?php if($wrongPassword) unset($_SESSION['wrongpassword']) ?>
        </div> 
        <div class='loginWindow__formRow'>
            <label for="password-input" class='loginWindow__label'>Пароль:</label>
            <input type="password" class='loginWindow__input' name='password' id='password-input' autocomplete='on' value= <?= $wrongPassword ? '' : 'antonova_da' ?>>
        </div>
        <div class='loginWindow__formRow loginWindow__btnRow'> 
            <input type="submit" class='loginWindow__Btn' value='Войти'> 
            <input type="button" class='loginWindow__Btn loginWindow__cancelBtn' value='Отмена'> 
        </div>
    </form></div>

    <script src="../js/login.js"></script>
</body>
</html>