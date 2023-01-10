// выделение строки или удаление выделения при клике
let users = document.querySelectorAll('.usersTable__user');
let deleteBtn = document.querySelector('#deleteBtn');
const clearSelectUser = () => users.forEach(user => user.className = 'usersTable__user');
for(let i=0; i<users.length; i++){
    users[i].onclick = ()=>{
        if(users[i].className==='usersTable__user'){
            clearSelectUser();
            users[i].className = 'usersTable__user usersTable__user_active';
            deleteBtn.disabled = false;    
        }
        else{
            users[i].className = 'usersTable__user';
            deleteBtn.disabled = true;
        }
    }
}

// кнопка Удалить пользователя
document.querySelector('#deleteBtn').onclick = ()=>{
    let removableUser = document.querySelector('.usersTable__user_active');
    let login = removableUser.querySelector('#usersTable__login').innerHTML;
    location.href = '../scriptes/deleteUser.php?remuser='+login;
};