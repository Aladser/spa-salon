// кнопка Назад
document.querySelector('#newPassword__backBtn').onclick = () => window.open('../index.php', '_self');
const errorContainer = document.querySelector('.newUserForm__error');
let newUserExisted = errorContainer.getAttribute('data-newLogin'); 
// если попытка повторной регистрации
if(newUserExisted != ''){
    errorContainer.style.visibility = 'visible';
    errorContainer.textContent = 'Пользователь уже существует';
    document.querySelector('.newUserForm__loginInput').value = newUserExisted;
}