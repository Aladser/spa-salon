let cancelBtn = document.querySelector('.loginWindow__cancelBtn');
if(cancelBtn) cancelBtn.addEventListener('click', () => window.open("../index.php", "_self"));

let loginBtn = document.querySelector('.loginWindow__loginBtn');
let loginInput = document.querySelector('.loginWindow__loginInput');
let passwordInput = document.querySelector('.loginWindow__passwordInput');

const checkFields = () => loginBtn.disabled = loginInput.value!=='' && passwordInput.value!=='' ? false : true; // проверка полей на пустоту
checkFields();
if(loginBtn){
    loginInput.addEventListener('input', checkFields);
    passwordInput.addEventListener('input', checkFields);
}