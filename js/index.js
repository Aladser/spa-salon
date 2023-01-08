/** модальное окно аутентификации */ let loginInputWindow = document.querySelector('#loginInputSection');
/** модальное окно ввода даты рождения */ let birthdayInputWindow = document.querySelector('#birthdayInputSection');
 
/** JSON от сервера */ const json = JSON.parse(document.querySelector('#data-php').getAttribute('data-json'));
const auth = json['auth']; // авторизация
const login = json['login']; // логин
const authTime = json['authtime']; // время авторизации
const birthday = parseInt(json['birthday']); // ДР
const endDiscountTime = parseInt(json['endDiscount']); // конец суточной скидки
const exitCount = parseInt(json['exit']); //** число выходов активного пользователя из личного кабинета */
const visitCount = json['visit']; /** число обновлений страницы активным пользователем */

// кнопка входа-выхода в шапке главной страницы
document.querySelector('.header__btn').onclick = function(){
    if(this.value=='Войти') loginInputWindow.className = 'modal modal_active';
    else window.open("../scriptes/exit.php", "_self");
};

// ***** Формирование имени пользователя и местного времени входа *****
document.querySelector('.header__user').textContent = auth ? `Здравствуйте,${login} (Время входа: ${getLocalHoursAndMinutes(authTime)})` : 'Здравствуйте, Гость!';

// ***** Отображение счетчика числа дней до ДР
let birthdayDiscount = document.querySelector('.discountBirthday');
let leftDays = birthday>0 ? formatTimeInterval(birthday-getDateNowInSeconds()).get('days') : -1;
if(birthday>0 && (leftDays==0 || exitCount>0))
{
    text = leftDays!=0 ? `До вашего дня рождения дней: ${leftDays}` :  'О, у вас день рождения. Поздравляем! Сегодня дарим вам скидку 5% на все наши услуги'; 
    birthdayDiscount.textContent = text;
    birthdayDiscount.style.display = 'flex';
    // если др сегодня
    if(leftDays == 0){
        document.querySelectorAll('.price').forEach( price => {
            price.className = 'price-discount';
            price.textContent = parseInt(price.textContent)*0.95 + 'Р'; 
        });
    }
}

//***** индивидуальная скидка ******
let uniqDiscount = document.querySelector('.discountUniq');
let nowTime = Math.floor(Date.now()/1000);

if(auth && nowTime<endDiscountTime && ((visitCount>1 && !birthday) || visitCount>2)){
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

//***** Кнопка показа номера *****
let callBtn = document.querySelector('.visit-card__btn');
callBtn.onmouseover = function() {this.value = '8 (421) 299-99-99';};
callBtn.onmouseout = function(){this.value = 'Позвонить';};