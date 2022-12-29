<!DOCTYPE html>
<html lang="en">

<?php
    session_start(); 
    $auth = $_SESSION['auth'] ?? null;
    if($auth){
        $login = $_SESSION['login']; // активный пользователь
        $_SESSION[$login]++; // число посещений активным пользователем
    }
    var_dump($_SESSION);
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
        <!-- показ кнопки Вход/выход в личный кабинет -->
        <?php 
            if($auth){
                echo "<form class='form-auth' method='POST' action='../php_scriptes/exit.php'>";
                echo "<input type='submit' class='btn-auth btn-exit' value='Выйти'>"; 
                echo "</form>";
           }else{
                echo "<a class='btn-auth' href='../pages/login.php'>Войти</a>";
        } 
        ?>
        <!-- отображение имени пользователя. Не используется getCurrentUser(), так как хранится активный пользователь в сессии -->        
        <p class='user-footer'><?php
            if($auth){
                $login = $_SESSION['login'];
                $authDate = date('H:i', $_SESSION['authTime']);
                echo "$login (Время входа: $authDate GMT+3)";
            }
            else echo "Здравствуйте, Гость!";       
        ?></p>
        
        <?php 
            // вывод числа дней до дня рождения
            if($auth && isset($_SESSION[$login.'birthDay'])) echo "<p class='before-birthday-prg'> До вашего дня рождения осталось 10 дней</p>"
        ?>
        <p class='name-company-prg'> СПА-салон <span class='name-company-prg__name'>На чиле</span></p>
    </footer>

    <main>

        <?php
            // переводит интервал времени в секундах в часы-минуты-секунды
            function getFormatTime($time){
                $interval['hours'] = floor($time/3600);
                $interval['minutes'] = floor($time%3600/60);
                $interval['seconds'] = floor($time%60);
                return $interval;
            }

            if($auth){ 
                // ***** индивидуальная скидка *****
                // при первом входе в личный кабинет в текущей сессии активируется индивидуальная скидка 
                if($_SESSION[$login] == 1){
                    $_SESSION['endDiscountTime'] = time() + 86400; // время конца скидки
                }
                // показ индивидуальной скидки, если прошло меньше суток, при последующих посещениях и обновлениях
                elseif(time()<$_SESSION['endDiscountTime']){
                    $leftTime = getFormatTime($_SESSION['endDiscountTime']-time());

                    echo "<section class='container'><p class='discount-container'>";
                    echo "Для вас индивидуальное предложение! Спешите!  Осталось ";
                    echo $leftTime['hours'].'ч. ';
                    echo $leftTime['minutes'].'мин. ';
                    echo $leftTime['seconds'].'с.';
                    echo "</p></section>";
                } 

                // ****  предложение ввода даты рождения при втором входе в личный кабинет во время текущей сессии *****
                $_SESSION[$login.'IsExit'] = $_SESSION[$login.'IsExit'] ?? 0;
                // отправка формы ввода даты
                if (isset($_POST['birthday'])){
                    --$_SESSION[$login];

                    $birthDate = explode('-', $_POST['birthday']);
                    $_SESSION[$login.'birthDay'] = $birthDate[2];
                    $_SESSION[$login.'birthMonth'] = $birthDate[1];

                    header('Location: index.php');              
                }
                // показ диалогового окна ввода даты
                elseif( $_SESSION[$login.'IsExit']==1 && !isset($_SESSION[$login.'birthDay'])){
                    $_SESSION[$login.'IsExit']++;
                    include 'pages/birthdayInputWindow.php';
                }

            }
        ?>
    </main>

    <script src="../js/modalBirthday.js"></script>
</body>
</html>