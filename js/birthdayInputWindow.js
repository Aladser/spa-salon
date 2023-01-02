let bithdayInputWindow = document.querySelector('#birthdayInputSection');
let bithdayInput = document.querySelector('.birthdaySendWindow__birthdayInput');
let sendBtn = document.querySelector('.birthdaySendWindow__sendBtn');
let closeBtn = document.querySelector('.birthdaySendWindow__closeBtn');

if(closeBtn) closeBtn.addEventListener('click', () => bithdayInputWindow.className='modal'); // Закрытие модального окна
if(bithdayInput) bithdayInput.addEventListener( 'input', () => sendBtn.disabled = false ); // разблокировка кнопки отправки при вводе даты