//***** Кнопка показа номера *****
let callBtn = document.querySelector('.btn-call');
callBtn.addEventListener('mouseover', function(){this.value = '8 (421) 299-99-99';});
callBtn.addEventListener('mouseout', function(){this.value = 'Позвонить';});

// ***** Формирование имени пользователя и времени входа *****
let headerUser = document.querySelector('.header__user');
let data = headerUser.textContent.split('-'); 
headerUser.textContent = data.length==2 ? `Здравствуйте,${data[0]} (Время входа: ${formatHoursAndMinutes(data[1])})` : 'Здравствуйте, Гость!';

// ***** Отображение скидки у цен
let birthdayDiscount = document.querySelector('.discount-birthday');
data = birthdayDiscount.textContent.split('-');
let birthday = data[0];
let extCount = data[1];
let prices = document.querySelectorAll('.price'); // цены

if(birthday && extCount)
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
data = document.querySelector('.uniqDiscountValue').textContent.split('-');
let auth = data[0]; // авторизирован?
let visits = data[1]; // посещения активным пользователем
let endDiscountTime = data[2]; // конец скидки
let nowTime = Math.floor(Date.now()/1000);

if(auth && visits>1 && nowTime<endDiscountTime){
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