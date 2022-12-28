// Закрытие модального окна ввода даты рождения на крестик
let closeBtn = document.querySelector('.modal__close-button');
let modalWindow = document.querySelector('.modal');
closeBtn.addEventListener('click', () => modalWindow.className='modal');
// Выбор даты
let bithdayInput = document.querySelector('.modal__birthday');
let sendBtn = document.querySelector('.modal__send-btn');
bithdayInput.addEventListener( 'input', function(){sendBtn.disabled = false;} );