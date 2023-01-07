// ***** вывод ошибки ввода логина или пароля *****
let errorContainer = document.querySelector('.loginWindow__error');
let errorMessage = errorContainer.textContent.split('-');
if(errorMessage.includes('Пользователя не существует') || errorMessage.includes('Неверный пароль')) loginInputWindow.className = 'modal modal_active';
errorContainer.textContent = errorContainer.textContent.replace('-', '');

// кнопка закрытия окна
let closeLoginWindowBtn = document.querySelector('#loginWindow__closeBtn');
if(closeLoginWindowBtn) closeLoginWindowBtn.onclick = () => document.querySelector('#loginInputSection').className = 'modal';

let loginBtn = document.querySelector('.loginWindow__loginBtn');
let loginInput = document.querySelector('.loginWindow__loginInput');
let passwordInput = document.querySelector('.loginWindow__passwordInput');

if(loginBtn){
    const checkFields = () => loginBtn.disabled = loginInput.value!=='' && passwordInput.value!=='' ? false : true; // проверка полей на пустоту
    checkFields();
    loginInput.addEventListener('input', checkFields);
    passwordInput.addEventListener('input', checkFields);
}
