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
    // авторизация
    if($auth){
        $login = $_SESSION['login']; // активный пользователь
        $_SESSION[$login]++; // число посещений активным пользователем
        $birthday =  $_SESSION[$login.'Birthday'] ?? false; // ДР
        $isBirthday = $birthday ? ($birthday - getDateNowInSeconds()) == 0 : false; // флаг, что ДР сегодня
        $_SESSION[$login.'IsExit'] = $_SESSION[$login.'IsExit'] ?? 0; // число выходов
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
                echo "<input type='submit' class='footer_btn footer__btn-exit' value='Выйти'>"; 
                echo "</form>";
           }else{
                echo "<a class='footer_btn footer_btn-login' href='../pages/login.php'>Войти</a>";
        } 
        ?>
        <!-- отображение имени пользователя. Не используется getCurrentUser(), так как хранится активный пользователь в сессии -->        
        <p class='footer__user'><?php
            if($auth){
                $authDate = date('H:i', $_SESSION['authTime']);
                echo "$login (Время входа: $authDate GMT+3)";
            }
            else 
                echo "Здравствуйте, Гость!";       
        ?></p>
        
        <p class='footer__title'> СПА-салон&nbsp; <span class='footer__company'> НА ЧИЛЕ</span></p>
        <nav class="footer__menu"><ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Фотогалерея</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Контакты</a></li>
        </ul></nav>    
    </footer>

    <main>
        <?php
            if($auth){ 
                // ***** индивидуальная скидка *****
                // при первом входе активируется индивидуальная скидка 
                if($_SESSION[$login] == 1){
                    $_SESSION['endDiscountTime'] = time() + 86400; // время конца скидки
                }
                // показ индивидуальной скидки, если прошло меньше суток
                // выводится при обновлении страницы после первой авторизации. Далее выводится сразу же после авторизации
                else{
                    $pagesUpdates =  $_SESSION[$login]; // число обновлений страницы
                    $isDiscount = time()<$_SESSION['endDiscountTime']; // прошло < 24 часов?
                    $isWritenBirthday = isset($_SESSION['borzenko_ysBirthday']); // записана дата рождения?
                      
                    if( ($pagesUpdates>0 && $isDiscount && !$isWritenBirthday) || ($pagesUpdates>1 && $isDiscount && $isWritenBirthday)){
                        $leftTime = getFormatTimeInterval($_SESSION['endDiscountTime']-time());
    
                        echo "<p class='container discount-container'>";
                        echo "Для вас индивидуальное предложение! Спешите!  Осталось ";
                        echo $leftTime['hours'].'ч. ';
                        echo $leftTime['minutes'].'мин. ';
                        echo $leftTime['seconds'].'с.';
                        echo "</p>";
                    }    
                }               
                // ****  скидка в честь дня рождения *****
                // показ диалогового окна ввода даты
                if( $_SESSION[$login.'IsExit']==0 && !isset($_SESSION[$login.'birthDay'])){
                    $_SESSION[$login.'IsExit']++;
                    include 'pages/birthdayInputWindow.php';
                }
                // отлов формы ввода ДР
                if (isset($_POST['birthday'])){
                    $_SESSION[$login]-=2; // не учитывается редирект
                    
                    // формирование даты ДР для подсчета числа дней до него
                    $birthDate = explode('-', $_POST['birthday']);
                    $birthDay = $birthDate[2];
                    $birthMonth = $birthDate[1];
                    if($birthMonth>date('m')) $birthYear = date('Y');
                    elseif($birthMonth===date('m') && $birthDay>=date('d')) $birthYear = date('Y');
                    else $birthYear = date('Y')+1;
    
                    $_SESSION[$login.'Birthday'] = mktime(0,0,0, $birthMonth, $birthDay, $birthYear); // запись ДР в секундах
                    header('Location: index.php');              
                }
                // вывод числа дней до ДР
                // если введен ДР и сегодня ДР, то сразу же выходит поздравление
                // иначе при повторных авторизациях
                if($auth && isset($_SESSION[$login.'Birthday']) && ($_SESSION[$login.'IsExit']>1 || $isBirthday))
                {
                    $interval = $_SESSION[$login.'Birthday'] - getDateNowInSeconds();
                    if($interval!=0)
                        $text = 'До вашего дня рождения осталось '.getFormatTimeInterval($interval)['days'].' дней'; 
                    else 
                        $text = 'О, сегодня ваш день рождения. Поздравляем! Сегодня дарим вас скидку 5% на все наши услуги';
                    echo "<p class='container'>$text</p>";
                }
            }
        ?>
        <section class='container'>
            <h2>Услуги</h2>
            <div class='services-container'>
            <section class='service'>
                <h3>Традиционный тайский массаж</h3>
                <img src="img/srv1.png" alt="">
                <p class='service__info'>Для здоровья и улучшения общего самочувствия.</p>
                <ul class='service__pricelist'>
                    <li>60 минут — 3600₽</li>
                    <li>90 минут — 5400₽</li>
                    <li>120 минут — 7200₽</li>
                </ul>
            </section>

            <section class='service'> 
                <h3>Массаж "Релакс"</h3>
                <img src="img/srv2.png" alt="">
                <p class='service__info'>Массаж расслабляет все тело, уходят зажимы, восстанавливается подвижность тела.</p>
                <ul class='service__pricelist'>
                    <li>60 минут — 3600₽</li>
                    <li>90 минут — 5400₽</li>
                    <li>120 минут — 7200₽</li>
                </ul>
            </section>

            <section class='service'>
                <h3>Массаж "Тоник" (лимфодренажный)</h3>
                <img src="img/srv3.png" alt="">
                <p class='service__info'>Выполняется движениями от конечностей к центру тела.
                    Перед массажем нужно выпить стакан воды. 
                    Хорошо устраняет отечность тела. Легкость, здоровье, стройность.</p>
                <ul class='service__pricelist'>
                    <li>60 минут — 3900₽</li>
                    <li>90 минут — 5850₽</li>
                    <li>120 минут — 7800₽</li>
                </ul>
            </section>

            <section class='service'>
                <h3>SPA-ритуал "ШокоСПА "</h3>
                <img src="img/srv4.png" alt="">
                <p class='service__info'>Баунти — самая экзотическая программа со вкусом кокоса и натурального темного шоколада.
                Кокосовое молоко, мякоть и живительное кокосовое масло с древних времен используют в Таиланде 
                для оздоровления всего организма, ухода за кожей и волосами.</p>
                <ul class='service__pricelist'>
                    <li>150 минут — 9000₽</li>
                </ul>
            </section>

            <section class='service'>
                <h3>SPA-ритуал "Королевский лотос"</h3>
                <img src="img/srv5.png" alt="">
                <p class='service__info'>Программа, созданная на основе экстрактов цветов королевского лотоса. 
                Вначале — исцеляющая парная или сауна, для разогревания мышц и очищения кожи. 
                Затем — ароматный пилинг с эфирным маслом тайского королевского лотоса. Расслабляющий тайский массаж с горячим маслом.</p>
                <ul class='service__pricelist'>
                    <li>120 минут — 7200₽</li>
                </ul>
            </section>
            </div>
        </section>
    </main>

    <script src="../js/modalBirthday.js"></script>
</body>
</html>