let users = document.querySelectorAll('.usersTable__user');
let deleteBtn = document.querySelector('#deleteBtn');

// убрать существующее выделение другой строки
function clearSelectedUser(){
    let selectedUser = document.querySelector('.usersTable__user_active');
    if(selectedUser) selectedUser.className = 'usersTable__user';
}

// выделение строки или удаление выделения при клике
for(let i=0; i<users.length; i++){
    users[i].onclick = ()=>{
        if(users[i].className==='usersTable__user'){
            clearSelectedUser();
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