let bithdayInputWindow = document.querySelector('#birthdayInputSection');
let bithdayInput = document.querySelector('.modal__birthday');
let sendBtn = document.querySelector('#send-btn');
let closeBtn = document.querySelector('.modal__close-button');

// Закрытие модального окна ввода даты рождения на крестик
if(closeBtn) closeBtn.addEventListener('click', () => bithdayInputWindow.className='modal');

// разблокировка кнопки отправки при вводе даты
if(bithdayInput) bithdayInput.addEventListener( 'input', () => sendBtn.disabled = false );