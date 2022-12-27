<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    // счетчик посещений
    $_SESSION['count'] = $_SESSION['count'] ?? 0;
    $_SESSION['count']++;
    
    $auth = $_SESSION['auth'] ?? null;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
    <title> СПА-салон </title>
</head>

<body>

    <footer class='footer'>
        <!-- Вход/выход в личный кабинет -->
        <?php
            if($auth)
                echo "<form class='form-auth' method='POST' action='../php_scriptes/exit.php'><input type='submit' class='btn-auth btn-exit' value='Выйти'> </form>";
            else
                echo "<a class='btn-auth' href='../pages/login.php'>Войти</a>";
        ?>
        <!--  отображение имени пользователя 
            не используется getCurrentUser(), чтобы не подключать db.php
        -->        
        <p class='user-footer'><?php
            if($auth){
                $login = $_SESSION['login'];
                $startHours = $_SESSION['startHours'];
                $startMinutes = $_SESSION['startMinutes']; 
                echo "$login (Время входа: $startHours:$startMinutes GMT+3)";
            }
            else{
                echo $_SESSION['count']==1 ?  "Здравствуйте, Гость!" : "Хотите войти в личный кабинет?";       
            } 
        ?></p>
        <p class='name-company-footer'> СПА-салон <span class='name-company-footer__name'>На чиле</span></p>
    </footer>

    <main>
        <!-- индивидуальная скидка -->
        <?php
            if($auth){
                $time = explode(':', date('G:i'));
                $nowHours = 23 - $time[0];
                $nowMinutes = 60 - $time[1];

                echo "<section class='container'><p class='discount-container'>";
                echo "Для вас индивидуальное предложение! Спешите!  Осталось ";
                echo $nowHours != 0 ? "$nowHours ч. $nowMinutes мин." : "$nowMinutes мин.";
                echo "</p></section>";
            }
        ?>
        <!-- Ввод даты рождения при втором посещении сайта-->
        <?php if($auth && $_SESSION['count']==2){ ?>
            <section class="modal modal_active">
                <div class="modal__content">
                    <button class="modal__close-button">x</button>
                    <h1 class="modal__title">Введите вашу дату рождения</h1>
                    <form method="POST" class='birthday-form' action='php_scriptes/birthday.php'>
                        <input type="date" class='modal__birthday'>
                        <input type="submit" class='modal__send-btn' value="Отправить">
                    </form>
                </div>
            </section>
        <?php }?>

    </main>
    <script src="js/modal.js"></script>
</body>
</html>