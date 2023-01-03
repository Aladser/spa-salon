const isNumber = (num) => typeof num === 'number' && !isNaN(num); // проверка на число
let loginInputWindow = document.querySelector('#loginInputSection');  // окно аутентификации
let headerBtn = document.querySelector('.header__btn'); // кнопка входа-выхода в шапке
let exitCount; // число выходов активного пользователя из личного кабинета
let auth; // авторизован?
let data; // данные тегов

// ***** Формирование имени пользователя и времени входа *****
let headerUser = document.querySelector('.header__user');
data = headerUser.textContent.split('-'); 
auth = data.length==2 ? true : false;
headerUser.textContent = auth ? `Здравствуйте,${data[0]} (Время входа: ${formatHoursAndMinutes(data[1])})` : 'Здравствуйте, Гость!';

// ***** вывод ошибки ввода логина или пароля *****
let errorContainer = document.querySelector('.loginWindow__error');
let errorMessage = errorContainer.textContent.split('-');
if(errorMessage.includes('Пользователя не существует') || errorMessage.includes('Неверный пароль')){
    loginInputWindow.className = 'modal modal_active';
}
errorContainer.textContent = errorContainer.textContent.replace('-', '');

document.querySelector('.header__btn').addEventListener('click', function(){
    if(this.value=='Войти') 
        loginInputWindow.className = 'modal modal_active';
    else 
        window.open("../scriptes/exit.php", "_self");
    this.value = this.value =='Войти' ? 'Выйти' : 'Войти'; 
});

// ***** Показ окна ввода даты рождения *****
data = document.querySelector('#exitValue').textContent.split('-');
exitCount = parseInt(data[0]); // число выходов активного пользователя из личного кабинета
let visitCount = parseInt(data[1]); // // число обновлений страницы пользователем
let birhdayInputWindow = document.querySelector('#birthdayInputSection');
if(auth && exitCount==0 && visitCount==1) birhdayInputWindow.className = 'modal modal_active'; // показывает окно при первом входе в личный кабинет

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
data = uniqDiscount.textContent.split('-');
//let auth = data[0]; // авторизирован?
let visits = data[1]; // посещения активным пользователем
let endDiscountTime = data[2]; // конец скидки
birthday = data[3]; // дата рождения
let nowTime = Math.floor(Date.now()/1000);

if(auth && nowTime<endDiscountTime && (visits>1&&!birthday || visits>2)){
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

