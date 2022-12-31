function getHoursAndMinutes(time){
    let date = new Date(time*1000);
    let hours = date.getHours(); 
    hours = hours<10 ? `0${hours}` : hours;
    let minutes = date.getMinutes(); 
    minutes = minutes<10 ? `0${minutes}` : minutes;
    return `${hours}:${minutes}`;
}

let callBtn = document.querySelector('.btn-call');
callBtn.addEventListener('mouseover', function(){this.value = '8 (421) 299-99-99';});
callBtn.addEventListener('mouseout', function(){this.value = 'Позвонить';});

// Формирование имя пользователя и времени входа
let headerUser = document.querySelector('.header__user');
let data = headerUser.textContent.split('-'); 
headerUser.textContent = data.length==2 ? `Здравствуйте,${data[0]} (Время входа: ${getHoursAndMinutes(data[1])})` : 'Здравствуй, Гость!';

// учет часового пояса
let srvHours = parseInt(document.querySelector('#srvTime').textContent);
let localHours = new Date().getHours();
let timeZone = localHours<srvHours ? 24+localHours-srvHours : localHours-srvHours;
document.querySelector('#srvTime').textContent = timeZone; 

