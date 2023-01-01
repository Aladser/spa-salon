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
    <section class='loginSection'><form method="POST" action='../php_scriptes/auth.php'>
        <h3 class='loginSection__header'> Авторизация</h3>

        <?php
            session_start();
            
            // вывод сообщения о неправильном логине или пароле
            $nouser = $_SESSION['nouser'] ?? null;
            $wrongPassword = $_SESSION['wrongpassword'] ?? null;
            if($nouser){
                echo "<div class='error'>Пользователь не существует</div>";
                unset($_SESSION['nouser']);
            }
            elseif($wrongPassword)
                echo "<div class='error'>Неверный пароль</div>";      
        ?>

        <div class='form-row'>
            <label for="login-input" class='form-row__label'>Логин:</label>
            <!-- показ логина, если неправильный пароль или выход из личного кабинета-->
            <input type='text' class='login-input' name='login' id='login-input' autocomplete='on' value='borzenko_ys'>
            <?php
                $login = $_SESSION['login'] ?? null;
                if($wrongPassword) unset($_SESSION['wrongpassword']);
            ?>
        </div>
        <div class='form-row'>
            <label for="password-input" class='form-row__label'>Пароль:</label>
            <input type="password" class='password-input' name='password' id='password-input' autocomplete="on" value='borzenko_ys'>
        </div>
        <div class='form-row form-btn-row'>
            <input class='btn-submit' type="submit" value='Войти'>
        </div>
    </form></section>
    <script src="../js/login.js"></script>
</body>
</html>