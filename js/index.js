/** проверка на число */ const isNumber = (num) => typeof num === 'number' && !isNaN(num);
/** модальное окно аутентификации */ let loginInputWindow = document.querySelector('#loginInputSection');
/** модальное окно ввода даты рождения */ let birthdayInputWindow = document.querySelector('#birthdayInputSection'); 
/** кнопка входа-выхода в шапке главной страницы */ let headerBtn = document.querySelector('.header__btn');
/** флаг авторизации */ let auth;
let data = document.querySelector('#exitValue').textContent.split('-');
/** число выходов активного пользователя из личного кабинета */ let exitCount = parseInt(data[0]);
/** число обновлений страницы активным пользователем */ let visitCount = parseInt(data[1]);

// ***** Формирование имени пользователя и времени входа *****
let headerUser = document.querySelector('.header__user');
data = headerUser.textContent.split('-'); 
auth = data.length==2 ? true : false;
headerUser.textContent = auth ? `Здравствуйте,${data[0]} (Время входа: ${formatHoursAndMinutes(data[1])})` : 'Здравствуйте, Гость!';

headerBtn.addEventListener('click', function(){
    if(this.value=='Войти') 
        loginInputWindow.className = 'modal modal_active';
    else 
        window.open("../scriptes/exit.php", "_self");
    this.value = this.value =='Войти' ? 'Выйти' : 'Войти'; 
});

//***** Кнопка показа номера *****
let callBtn = document.querySelector('.btn-call');
callBtn.addEventListener('mouseover', function(){this.value = '8 (421) 299-99-99';});
callBtn.addEventListener('mouseout', function(){this.value = 'Позвонить';});

// ***** Отображение счетчика числа дней до ДР
let birthdayDiscount = document.querySelector('.discount-birthday');
let birthday = parseInt(birthdayDiscount.textContent);
let prices = document.querySelectorAll('.price'); // цены

if(isNumber(birthday) && isNumber(exitCount))
{
    let leftDays =  formatTimeInterval(birthday-getDateNowInSeconds()).get('days');
    text = leftDays!=0 ? `До вашего дня рождения дней: ${leftDays}` :  'О, у вас день рождения. Поздравляем! Сегодня дарим вам скидку 5% на все наши услуги'; 
    birthdayDiscount.textContent = text;
    birthdayDiscount.style.display = 'flex';
    // если др сегодня
    if(leftDays == 0){
        prices.forEach( price => {
            price.className = 'price-discount';
            price.textContent = parseInt(price.textContent)*0.95 + 'Р'; 
        });
    }
}

//***** индивидуальная скидка ******
let uniqDiscount = document.querySelector('.discount-uniq');
let endDiscountTime = parseInt(uniqDiscount.textContent);
let nowTime = Math.floor(Date.now()/1000);

if(auth && nowTime<endDiscountTime && (visitCount>1&& !birthday || visitCount>2)){
    let leftTime = formatTimeInterval(endDiscountTime-nowTime);
    let countdown = `Для вас индивидуальное предложение! Спешите! Осталось ${leftTime.get('hours')}ч ${leftTime.get('minutes')}мин ${leftTime.get('seconds')}сек`;
    uniqDiscount.textContent = countdown;
    uniqDiscount.style.display = 'flex';
    let timerID = setInterval(() => {
        nowTime = Math.floor(Date.now()/1000);
        leftTime = formatTimeInterval(endDiscountTime-nowTime);
        if((endDiscountTime-nowTime) > 0){
            countdown = `Для вас индивидуальное предложение! Спешите! Осталось ${leftTime.get('hours')}ч ${leftTime.get('minutes')}мин ${leftTime.get('seconds')}сек`;
            uniqDiscount.textContent = countdown;
        }
        else{
            clearTimeout(timerID);
            uniqDiscount.style.display = 'none';
        }
    }, 500);
}

