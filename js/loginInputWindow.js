let cancelBtn = document.querySelector('.loginWindow__cancelBtn');
if(cancelBtn) cancelBtn.addEventListener('click', () => {
    document.querySelector('#loginInputSection').className = 'modal';
    window.open("../index.php", "_self")
});

let loginBtn = document.querySelector('.loginWindow__loginBtn');
let loginInput = document.querySelector('.loginWindow__loginInput');
let passwordInput = document.querySelector('.loginWindow__passwordInput');

if(loginBtn){
    const checkFields = () => loginBtn.disabled = loginInput.value!=='' && passwordInput.value!=='' ? false : true; // проверка полей на пустоту
    checkFields();
    loginInput.addEventListener('input', checkFields);
    passwordInput.addEventListener('input', checkFields);
}