<!DOCTYPE html><html lang="en">
<?php
    session_start();
    
    $auth = $_SESSION['auth'] ?? null; // авторизация
    $login = $_SESSION['login'] ?? null; // активный пользователь
    $authDate = $_SESSION['authTime'] ?? null;  // время авторизации
    if($auth){
        $_SESSION[$login]['visits']++; // число обновлений страницы активным пользователем
        $birthday =  $_SESSION[$login]['birthday'] ?? false; // ДР
        $_SESSION[$login]['exit'] = $_SESSION[$login]['exit'] ?? 0; // число выходов
    }

    //var_dump($_SESSION);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
    <title> СПА-салон «На Чиле»</title>
</head>

<body>
    <script type='text/javascript' src='js/dateFunc.js'></script>

    <header class='header'>
    <!-- Кнопка входа/выхода -->
    <?php $action = $auth ? '../php_scriptes/exit.php' : '../pages/login.php' ?>
    <form class='form-auth' method='POST' action= <?=$action?>>
        <input type='submit' class='header__btn' value= <?=$auth ? 'Выйти' : 'Войти'?>>
    </form>
    <!-- имя пользователя и время входа -->
    <p class='header__user'> <?= $login ? "$login-$authDate" : null ?> </p>
    <!-- заголовок -->
    <p class='header__title'> <img src="img/icon.png" alt="СПА-салон"> НА ЧИЛЕ</p>
    <!-- меню навигации -->
    <nav class="header__menu"><ul>
        <li><a href="#">Главная</a></li>
        <li><a href="#">Услуги</a></li>
        <li><a href="#">Фотогалерея</a></li>
        <li><a href="#">О нас</a></li>
        <li><a href="#">Контакты</a></li>
    </ul></nav>    
    </header>

    <main>
    <section class='container visit-card'>
        <p class='visit-card__company-name'> На Чиле </p>
        <p class='visit-card__address'>Спа-Салон (г.Благовещенск, ул.Пролетарская, д.5)</p>
        <p class='visit-card__schedule'>Круглосуточно</p>
        <input type="button" class='btn btn-call' value="Позвонить">
    </section>
      
    <?php
        if($auth){ 
            // ***** индивидуальная скидка *****
            // при первом входе активируется индивидуальная скидка 
            if($_SESSION[$login]['visits'] == 1){
                $_SESSION[$login]['endDiscount'] = time() + 86400; // время конца скидки
            }              
            // ****  скидка в честь ДР *****
            // показ диалогового окна ввода даты
            // на числе $_SESSION[$login]['exit'] завязан вывод окна ввода даты
            if( $_SESSION[$login]['exit']==0){
                $_SESSION[$login]['exit']++;
                include 'pages/birthdayInputWindow.php';
            }
            // отлов формы ввода ДР
            if (isset($_POST['birthday'])){
                $_SESSION[$login]['visits']-=2; // не учитывается редирект
                
                // формирование даты ДР для подсчета числа дней до него
                $birthDate = explode('-', $_POST['birthday']);
                $birthDay = $birthDate[2];
                $birthMonth = $birthDate[1];

                if($birthMonth>date('m')) $birthYear = date('Y');
                elseif($birthMonth===date('m') && $birthDay>=date('d')) $birthYear = date('Y');
                else $birthYear = date('Y')+1;          

                $_SESSION[$login]['birthday'] = mktime(0,0,0, $birthMonth, $birthDay, $birthYear); // запись ДР в секундах
                header('Location: index.php');              
            }
        }         
    ?>
    <!-- индивидуальная скидка -->
    <p style='display:none' id='uniqDiscountValue'><?=$auth.'-'.$_SESSION[$login]['visits'].'-'.$_SESSION[$login]['endDiscount']?></p>
    <p class='discount discount-uniq'></p>
    <!-- контейнер числа дней до ДР -->
    <?php
        $birthday = $_SESSION[$login]['birthday']??null;
        $exit = $_SESSION[$login]['exit']??null;
    ?>
    <p class='discount discount-birthday'><?= $birthday.'-'.$exit ?></p>

    <section class='container'>
        <h2 class='services-container__title'>Услуги</h2>
        <div class='services-container'>
        <section class='service'>
            <h3 class='service__title'>Традиционный тайский массаж</h3>
            <img src="img/srv1.png" alt="">
            <p class='service__info'>Для здоровья и улучшения общего самочувствия.</p>
            <ul class='service__pricelist'>
                <li>60 минут — <span class='price'>3600₽</span></li>
                <li>90 минут — <span class='price'>5400₽</span></li>
                <li>120 минут — <span class='price'>7200₽</span></li>
            </ul>
        </section>

        <section class='service'> 
            <h3 class='service__title'>Массаж "Релакс"</h3>
            <img src="img/srv2.png" alt="">
            <p class='service__info'>Массаж расслабляет все тело, уходят зажимы, восстанавливается подвижность тела.</p>
            <ul class='service__pricelist'>
                <li>60 минут — <span class='price'>3600₽</span></li>
                <li>90 минут — <span class='price'>5400₽</span></li>
                <li>120 минут — <span class='price'>7200₽</span></li>
            </ul>
        </section>

        <section class='service action-container'> 
            <p class='action-container__action'>Для пар скидка 20% по будням в вечерние часы </p>
            <p class='action-container__action'>В честь Нового года вы можете приобрести годовой абонемент со скидкой 10% до 7 января</p>
        </section>

        <section class='service'>
            <h3 class='service__title'>Массаж "Тоник" (лимфодренажный)</h3>
            <img src="img/srv3.png" alt="">
            <p class='service__info'>Выполняется движениями от конечностей к центру тела.
                Перед массажем нужно выпить стакан воды. 
                Хорошо устраняет отечность тела. Легкость, здоровье, стройность.</p>
            <ul class='service__pricelist'>
                <li>60 минут — <span class='price'>3900₽</span></li>
                <li>90 минут — <span class='price'>5800₽</span></li>
                <li>120 минут — <span class='price'>7800₽</span></li>
            </ul>
        </section>

        <section class='service'>
            <h3 class='service__title'>SPA-ритуал "ШокоСПА "</h3>
            <img src="img/srv4.png" alt="">
            <p class='service__info'>Баунти — самая экзотическая программа со вкусом кокоса и натурального темного шоколада.
            Кокосовое молоко, мякоть и живительное кокосовое масло с древних времен используют в Таиланде 
            для оздоровления всего организма, ухода за кожей и волосами.</p>
            <ul class='service__pricelist'>
                <li>150 минут — <span class='price'>9000₽</span></li>
            </ul>
        </section>

        <section class='service'>
            <h3 class='service__title'>SPA-ритуал "Королевский лотос"</h3>
            <img src="img/srv5.png" alt="">
            <p class='service__info'>Программа, созданная на основе экстрактов цветов королевского лотоса. 
            Вначале — исцеляющая парная или сауна, для разогревания мышц и очищения кожи. 
            Затем — ароматный пилинг с эфирным маслом тайского королевского лотоса. Расслабляющий тайский массаж с горячим маслом.</p>
            <ul class='service__pricelist'>
                <li>120 минут — <span class='price'>7200₽</span></li>
            </ul>
        </section>
        </div>
    </section>
    </main>

    <footer class='footer'>
            <p>г.Благовещенск, ул.Пролетарская, д.5</p>
            <p>8 (421) 299-99-99</p>
            <p>Электронная почта:test@test.ru</p>
            <p>Номер медицинской лицензии ЛО-76-01-002267 от 25.02.2020 г.</p>
            <p>СПА Салон ООО "На чиле"</p>
    </footer>

    <script type='text/javascript' src='js/modalBirthday.js'></script>
    <script type='text/javascript' src='js/index.js'></script>
</body>
</html>