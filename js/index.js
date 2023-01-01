let callBtn = document.querySelector('.btn-call');
callBtn.addEventListener('mouseover', function(){this.value = '8 (421) 299-99-99';});
callBtn.addEventListener('mouseout', function(){this.value = 'Позвонить';});

// Формирование имени пользователя и времени входа
let headerUser = document.querySelector('.header__user');
let data = headerUser.textContent.split('-'); 
headerUser.textContent = data.length==2 ? `Здравствуйте,${data[0]} (Время входа: ${getHoursAndMinutes(data[1])})` : 'Здравствуй, Гость!';

// показ дней до ДР
let birthdayDiscount = document.querySelector('.discount-birthday');
data = birthdayDiscount.textContent.split('-');
let birthday = data[0];
let extCount = data[1];

let prices = document.querySelectorAll('.price'); // цены
prices.forEach(price => console.log(price.textContent));
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