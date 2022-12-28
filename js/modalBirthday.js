let bithdayInputWindow = document.querySelector('#bithdayInputSection');
let bithdayInput = document.querySelector('.modal__birthday');
let sendBtn = document.querySelector('#send-btn');
let congratWindow = document.querySelector('#congratSection');

// Закрытие модального окна ввода даты рождения на крестик
document.querySelector('.modal__close-button').addEventListener('click', () => bithdayInputWindow.className='modal');

// разблокировка кнопки отправки при вводе даты
bithdayInput.addEventListener( 'input', function(){sendBtn.disabled = false;} );

// ввод даты рождения
sendBtn.addEventListener('click', ()=>{
    bithdayInputWindow.className = 'modal'; // скрыть модальное окно ввода даты
    // введенная дата
    let date = bithdayInput.value.split('-');
    let inputDay = parseInt(date[2]);
    let inputMonth = parseInt(date[1]);
    // текущее время
    let nowDate = new Date();
    let nowDay = nowDate.getDate();
    let nowMonth = nowDate.getMonth() + 1;

    if(inputDay === nowDay && inputMonth === nowMonth){
        congratWindow.className = 'modal modal_active';
    }
});

document.querySelector('#close-congrat-btn').addEventListener('click', () => congratWindow.className = 'modal'); // закрытие поздравления
