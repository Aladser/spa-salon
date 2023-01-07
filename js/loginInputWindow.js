// ***** вывод ошибки ввода логина или пароля *****
let errorContainer = document.querySelector('.loginWindow__error');
let errorMessage = errorContainer.textContent.split('-');
if(errorMessage.includes('Пользователя не существует') || errorMessage.includes('Неверный пароль')) loginInputWindow.className = 'modal modal_active';
errorContainer.textContent = errorContainer.textContent.replace('-', '');

// кнопка закрытия окна
let closeLoginWindowBtn = document.querySelector('#loginWindow__closeBtn');
if(closeLoginWindowBtn) closeLoginWindowBtn.onclick = () => document.querySelector('#loginInputSection').className = 'modal';

let loginBtn = document.querySelector('#loginWindow__sendBtn');
let loginInput = document.querySelector('.loginWindow__loginInput');
let passwordInput = document.querySelector('.loginWindow__passwordInput');

if(loginBtn){
    // проверка полей на пустоту
    const checkFields = () => loginBtn.disabled = loginInput.value!=='' && passwordInput.value!=='' ? false : true;
    checkFields();
    loginInput.addEventListener('input', checkFields);
    passwordInput.addEventListener('input', checkFields);
}
