// кнопка Назад
document.querySelector('#newPassword__backBtn').onclick = () => window.open('../index.php', '_self');

// если попытка повторной регистрации
const errorContainer = document.querySelector('.newUserForm__error');
const newUserExisted = errorContainer.getAttribute('data-newLogin');
if(newUserExisted != ''){
    errorContainer.style.visibility = 'visible';
    errorContainer.textContent = 'Пользователь уже существует';
    document.querySelector('#newUserForm__loginInput').value = newUserExisted;
}

// Проверка на пустоту
const newLoginRegBtn = document.querySelector('.newUserForm__regBtn');
const newLoginInput = document.querySelector('#newUserForm__loginInput');
const newPasswordInput = document.querySelector('#newUserForm__passwordInput');
const checkNewDataFields = () => newLoginRegBtn.disabled = newLoginInput.value!=='' && newPasswordInput.value!=='' ? false : true;
checkNewDataFields();
newLoginInput.oninput = checkNewDataFields;
newPasswordInput.oninput =  checkNewDataFields;