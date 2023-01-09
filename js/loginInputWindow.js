// вывод ошибки ввода логина или пароля
let errorContainer = document.querySelector('.loginWindow__error');
let errorMessage = errorContainer.textContent.split('-');
if(errorMessage.includes('Пользователя не существует') || errorMessage.includes('Неверный пароль')) 
    document.querySelector('#loginInputSection').className = 'modal modal_active';
errorContainer.textContent = errorContainer.textContent.replace('-', '');

// кнопка закрытия окна
let closeLoginWindowBtn = document.querySelector('#loginWindow__closeBtn');
if(closeLoginWindowBtn) closeLoginWindowBtn.onclick = () => document.querySelector('#loginInputSection').className = 'modal';

// проверка полей на пустоту
let loginBtn = document.querySelector('#loginWindow__sendBtn');
let loginInput = document.querySelector('.loginWindow__loginInput');
let passwordInput = document.querySelector('.loginWindow__passwordInput');
if(loginBtn){
    const checkFields = () => loginBtn.disabled = loginInput.value!=='' && passwordInput.value!=='' ? false : true;
    checkFields();
    loginInput.oninput =  checkFields;
    passwordInput.oninput =  checkFields;
}

// кнопка регистрации
document.querySelector('#loginWindow__regBtn').onclick = () => window.open("../pages/registrationWindow.php", "_self");