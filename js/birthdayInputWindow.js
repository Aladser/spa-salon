// показывает окно ввода ДР при первом входе в личный кабинет
// не отображается у admin
if(auth && exitCount==0 && visitCount==1 && login!=='admin') document.querySelector('#birthdayInputSection').className = 'modal modal_active'; 

// Закрытие модального окна
const closeBirthdaySendWindowBtn = document.querySelector('#birthdaySendWindow__closeBtn');
if(closeBirthdaySendWindowBtn) closeBirthdaySendWindowBtn.onclick = () => document.querySelector('#birthdayInputSection').className='modal'; 

// разблокировка кнопки отправки при вводе даты
let birthdayInput = document.querySelector('.birthdaySendWindow__birthdayInput');
if(birthdayInput) birthdayInput.oninput = () => document.querySelector('.birthdaySendWindow__sendBtn').disabled = false; 