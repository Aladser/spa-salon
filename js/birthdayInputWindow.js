let birthdayInput = document.querySelector('.birthdaySendWindow__birthdayInput');
let sendBtn = document.querySelector('.birthdaySendWindow__sendBtn');
let closeBtn = document.querySelector('.birthdaySendWindow__closeBtn');

// ***** Показ окна ввода даты рождения *****
if(auth && exitCount==0 && visitCount==1) birthdayInputWindow.className = 'modal modal_active'; // показывает окно при первом входе в личный кабинет
if(closeBtn) closeBtn.addEventListener('click', () => birthdayInputWindow.className='modal'); // Закрытие модального окна
if(birthdayInput) birthdayInput.addEventListener( 'input', () => sendBtn.disabled = false ); // разблокировка кнопки отправки при вводе даты