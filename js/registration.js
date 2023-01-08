const errorContainer = document.querySelector('.newUserForm__error');
if(errorContainer.textContent==='true'){
    errorContainer.style.visibility = 'visible';
    errorContainer.textContent = 'Пользователь уже существует';
}

document.querySelector('#newPassword__backBtn').onclick = () => window.open('../index.php', '_self');