let btn = document.querySelector('.btn-submit');
let loginInput = document.querySelector('.login-input');
let passwordInput = document.querySelector('.password-input');

// блокировать кнопку при пустом поле
const checkTextInputs = () => btn.disabled = loginInput.value!='' && passwordInput.value!='' ? false : true;
loginInput.addEventListener('input', () => checkTextInputs());
passwordInput.addEventListener('input', () => checkTextInputs());

passwordInput.addEventListener('click', function(){this.value = '';});