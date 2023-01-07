// ***** Показ окна ввода даты рождения *****
if(auth && exitCount==0 && visitCount==1) birthdayInputSection.className = 'modal modal_active'; // показывает окно при первом входе в личный кабине

let closeBirthdaySendWindowBtn = document.querySelector('#birthdaySendWindow__closeBtn');
if(closeBirthdaySendWindowBtn) closeBirthdaySendWindowBtn.onclick = () => birthdayInputSection.className='modal'; // Закрытие модального окна

let birthdayInput = document.querySelector('.birthdaySendWindow__birthdayInput');
if(birthdayInput) birthdayInput.oninput = () => document.querySelector('.birthdaySendWindow__sendBtn').disabled = false; // разблокировка кнопки отправки при вводе даты
