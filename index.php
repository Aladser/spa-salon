<!DOCTYPE html><html lang="en">
<?php
    include 'php_scriptes/dateFunc.php';
    session_start();
    // текущее время
    $nowTime = time();
    $nowTime = mktime(0,0,0,date('m', $nowTime),date('d', $nowTime),date('Y', $nowTime));
    
    // не используется getCurrentUser(), так как хранится активный пользователь в сессии
    $auth = $_SESSION['auth'] ?? null; // авторизация
    $login = $_SESSION['login'] ?? null; // активный пользователь
    if($auth){
        $_SESSION[$login]['visits']++; // число обновлений страниц активным пользователем
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
    <p style='display:none' id='srvTime'> <?= date('H') ?> </p>

    <header class='header'>
        <?php 
            // показ кнопки Вход/выход в личный кабинет
            if($auth){
                echo "<form class='form-auth' method='POST' action='../php_scriptes/exit.php'>";
                echo "<input type='submit' class='header__btn header__btn-exit' value='Выйти'>"; 
                echo "</form>";
           }else{
                echo "<a class='header__btn header__btn-login' href='../pages/login.php'>Войти</a>";
            }
            $authDate = $_SESSION['authTime'] ?? null;        
        ?>
        <!-- имя пользователя и время входа формируется в js-скрипте -->
        <p class='header__user'> <?php echo $login ? "$login-$authDate" : null ?> </p>
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
        <p class='discount discount-uniq'></p>

        <?php
            // коэффициент-скидка для ДР
            $birthdayDiscount = 1; // коэффициент скидки, 0.95 - 5%
            if($auth){ 
                // ***** индивидуальная скидка *****
                // при первом входе активируется индивидуальная скидка 
                if($_SESSION[$login]['visits'] == 1){
                    $_SESSION[$login]['endDiscount'] = time() + 86400; // время конца скидки
                }
                // показ индивидуальной скидки, если прошло меньше суток
                // выводится при обновлении страницы после первой авторизации. Далее выводится сразу же после авторизации
                else{
                    $pagesUpdates =  $_SESSION[$login]['visits']; // число обновлений страницы
                    $isDiscount = time()<$_SESSION[$login]['endDiscount']; // прошло < 24 часов?
                      
                    if($pagesUpdates>0 && $isDiscount){
        ?>                      
                        <script type="text/javascript">
                            let uniqDiscount = document.querySelector('.discount-uniq'); // контейнер индивид.скидки
                            uniqDiscount.style.display = 'flex';

                            let endDiscount = <?=$_SESSION[$login]['endDiscount']?>; // конец скидки
                            let nowTime;
                            let leftDays;

                            let timerID = setInterval(() => {
                                nowTime = Math.floor(Date.now()/1000);
                                leftDays = formatTimeInterval(endDiscount-nowTime);
                                if((endDiscount-nowTime) > 0){
                                    text = `Для вас индивидуальное предложение! Спешите! Осталось ${leftDays.get('hours')}ч ${leftDays.get('minutes')}мин ${leftDays.get('seconds')}сек.`;
                                    uniqDiscount.textContent = text;
                                }
                                else
                                    clearTimeout(timerID);
                            }, 1000);
                        </script>
        <?php       } else{ ?>
                        <script type="text/javascript"> uniqDiscount.style.display = 'none'; </script>
                    <?php }    
                }               
                // ****  скидка в честь дня рождения *****
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
                // вывод числа дней до ДР
                // если введен ДР, и сегодня ДР, то сразу же выходит поздравление
                // иначе при повторных авторизациях
                $isBirthday = $birthday ? ($birthday - $nowTime) == 0 : false; // флаг, что ДР сегодня
                if($auth && isset($_SESSION[$login]['birthday']) && ($_SESSION[$login]['exit']>1 || $isBirthday))
                {
                    $interval = $_SESSION[$login]['birthday'] - $nowTime;

                    if($interval!=0){

                        $days = getFormatTimeInterval($interval)['days'];
                        $text = "До вашего дня рождения дней: $days";
                    } 
                    else{
                        $text = 'О, у вас день рождения. Поздравляем! Сегодня дарим вас скидку 5% на все наши услуги';
                        $birthdayDiscount = 0.95;
                    }
                    echo "<p class='discount discount-birthday'>$text</p>";
                }
                //показ псевдоэлемента скидки
                if($birthdayDiscount !=1 ) echo "<style>.service__pricelist li::after{content: ' -5%';}</style>"; 
            }
        ?>

        <section class='container'>
            <h2 class='services-container__title'>Услуги</h2>
            <div class='services-container'>
            <section class='service'>
                <h3 class='service__title'>Традиционный тайский массаж</h3>
                <img src="img/srv1.png" alt="">
                <p class='service__info'>Для здоровья и улучшения общего самочувствия.</p>
                <ul class='service__pricelist'>
                    <li>60 минут — <?php echo 3600*$birthdayDiscount.'₽'?></li>
                    <li>90 минут — <?php echo 5400*$birthdayDiscount.'₽' ?></li>
                    <li>120 минут — <?php echo 7200*$birthdayDiscount.'₽' ?></li>
                </ul>
            </section>

            <section class='service'> 
                <h3 class='service__title'>Массаж "Релакс"</h3>
                <img src="img/srv2.png" alt="">
                <p class='service__info'>Массаж расслабляет все тело, уходят зажимы, восстанавливается подвижность тела.</p>
                <ul class='service__pricelist'>
                    <li>60 минут — <?php echo 3600*$birthdayDiscount ?>₽</li>
                    <li>90 минут — <?php echo 5400*$birthdayDiscount ?>₽</li>
                    <li>120 минут — <?php echo 7200*$birthdayDiscount ?>₽</li>
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
                    <li>60 минут — <?php echo 3900*$birthdayDiscount ?>₽</li>
                    <li>90 минут — <?php echo 5800*$birthdayDiscount ?>₽</li>
                    <li>120 минут — <?php echo 7800*$birthdayDiscount ?>₽</li>
                </ul>
            </section>

            <section class='service'>
                <h3 class='service__title'>SPA-ритуал "ШокоСПА "</h3>
                <img src="img/srv4.png" alt="">
                <p class='service__info'>Баунти — самая экзотическая программа со вкусом кокоса и натурального темного шоколада.
                Кокосовое молоко, мякоть и живительное кокосовое масло с древних времен используют в Таиланде 
                для оздоровления всего организма, ухода за кожей и волосами.</p>
                <ul class='service__pricelist'>
                    <li>150 минут — <?php echo 9000*$birthdayDiscount ?>₽</li>
                </ul>
            </section>

            <section class='service'>
                <h3 class='service__title'>SPA-ритуал "Королевский лотос"</h3>
                <img src="img/srv5.png" alt="">
                <p class='service__info'>Программа, созданная на основе экстрактов цветов королевского лотоса. 
                Вначале — исцеляющая парная или сауна, для разогревания мышц и очищения кожи. 
                Затем — ароматный пилинг с эфирным маслом тайского королевского лотоса. Расслабляющий тайский массаж с горячим маслом.</p>
                <ul class='service__pricelist'>
                    <li>120 минут — <?php echo 7200*$birthdayDiscount ?>₽</li>
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