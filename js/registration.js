// кнопка Назад
document.querySelector('#newPassword__backBtn').onclick = () => window.open('../index.php', '_self');

// если попытка повторной регистрации
const errorContainer = document.querySelector('.newUserForm__error');
const newUserExisted = errorContainer.getAttribute('data-newLogin'); 
if(newUserExisted != ''){
    errorContainer.style.visibility = 'visible';
    errorContainer.textContent = 'Пользователь уже существует';
    document.querySelector('.newUserForm__loginInput').value = newUserExisted;
}