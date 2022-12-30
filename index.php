<!DOCTYPE html>
<html lang="en">

<?php
    // получить текущее время
    function getDateNowInSeconds(){
        $time = time();
        return mktime(0,0,0,date('m', $time),date('d', $time),date('Y', $time));
    }
    // переводит интервал времени в секундах в часы-минуты-секунды
    function getFormatTimeInterval($time){
        $interval['days'] = intval(floor($time/86400));
        $interval['hours'] = intval(floor($time%86400/3600));
        $interval['minutes'] = intval(floor($time%86400%3600/60));
        $interval['seconds'] = intval(floor($time%86400%3600%60));
        return $interval;
    }

    session_start(); 
    $auth = $_SESSION['auth'] ?? null;
    if($auth){
        $login = $_SESSION['login']; // активный пользователь
        $_SESSION[$login]++; // число посещений активным пользователем
    }
    //foreach($_SESSION as $key => $value) echo "$key => $value<br>";
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
            // отлов формы ввода даты ДР
            if (isset($_POST['birthday'])){
                --$_SESSION[$login];
                
                // формирование даты ДР для подсчета числа дней до него
                $birthDate = explode('-', $_POST['birthday']);
                $birthDay = $birthDate[2];
                $birthMonth = $birthDate[1];
                if($birthMonth>date('m')) $birthYear = date('Y');
                elseif($birthMonth===date('m') && $birthDay>=date('d')) $birthYear = date('Y');
                else $birthYear = date('Y')+1;

                $_SESSION[$login.'Birthday'] = mktime(0,0,0, $birthMonth, $birthDay, $birthYear); // запись ДР в сессию в секундах от 1970г.
                $_SESSION[$login]--; // редирект отправки формы не учитывается
                header('Location: index.php');              
            }
            if($auth) 
                $isBirthday = isset($_SESSION[$login.'Birthday']) ? ($_SESSION[$login.'Birthday'] - getDateNowInSeconds()) == 0 : null;

            // вывод числа дней до дня рождения
            if($auth && isset($_SESSION[$login.'Birthday']) && ($_SESSION[$login.'IsExit']>1 || $isBirthday))
            {
                $interval = $_SESSION[$login.'Birthday'] - getDateNowInSeconds();
                if($interval!=0)
                    $text = 'До вашего дня рождения осталось '.getFormatTimeInterval($interval)['days'].' дней'; 
                else 
                    $text = 'О, сегодня ваш день рождения. Поздравляем! Сегодня дарим вас скидку 5% на все наши услуги';
                echo "<p class='before-birthday-prg'>$text</p>";
            }
        ?>
        <p class='name-company-prg'> СПА-салон <span class='name-company-prg__name'>НА ЧИЛЕ</span></p>
    </footer>

    <main>
        <?php
            if($auth){ 
                // ***** индивидуальная скидка *****
                // при первом входе текущей сессии в личный кабинет активируется индивидуальная скидка 
                if($_SESSION[$login] == 1){
                    $_SESSION['endDiscountTime'] = time() + 86400; // время конца скидки
                }
                // показ индивидуальной скидки, если прошло меньше суток, при последующих посещениях и обновлениях
                else{
                    $pagesUpdates =  $_SESSION[$login]; // число обновлений страницы
                    $isDiscount = time()<$_SESSION['endDiscountTime']; // активность скидки на 24 часа
                    $isWritenBirthday = isset($_SESSION['borzenko_ysBirthday']); // записана ли дата рождения

                    if( ($pagesUpdates>0 && $isDiscount && !$isWritenBirthday) || ($pagesUpdates>1 && $isDiscount && $isWritenBirthday)){
                        $leftTime = getFormatTimeInterval($_SESSION['endDiscountTime']-time());
    
                        echo "<section class='container'><p class='discount-container'>";
                        echo "Для вас индивидуальное предложение! Спешите!  Осталось ";
                        echo $leftTime['hours'].'ч. ';
                        echo $leftTime['minutes'].'мин. ';
                        echo $leftTime['seconds'].'с.';
                        echo "</p></section>";
                    }    
                }
                
                // ****  скидка в честь дня рождения *****
                $_SESSION[$login.'IsExit'] = $_SESSION[$login.'IsExit'] ?? 0;
                // показ диалогового окна ввода даты
                if( $_SESSION[$login.'IsExit']==0 && !isset($_SESSION[$login.'birthDay'])){
                    $_SESSION[$login.'IsExit']++;
                    include 'pages/birthdayInputWindow.php';
                }

            }
        ?>
    </main>

    <script src="../js/modalBirthday.js"></script>
</body>
</html>