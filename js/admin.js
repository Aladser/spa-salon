let users = document.querySelectorAll('.usersTable__user');
let deleteBtn = document.querySelector('#btnBlock__deleteBtn');

// переключить видимость
function toggleSelection(elem){
    elem.className = elem.className==='usersTable__user' ? 'usersTable__user usersTable__user_active' : 'usersTable__user';  
}

// убрать существующее выделение другой строки
function clearSelectedUser(){
    let selectedUser = document.querySelector('.usersTable__user_active');
    if(selectedUser) toggleSelection(selectedUser);
}

// выделение строки или удаление выделения при клике
for(let i=0; i<users.length; i++){
    users[i].onclick = ()=>{
        if(users[i].className==='usersTable__user') clearSelectedUser();
        toggleSelection(users[i]);
        deleteBtn.disabled = deleteBtn.disabled ? false : true; 
    }
}

// кнопка Удалить пользователя
deleteBtn.onclick = ()=>{
    let removableUser = document.querySelector('.usersTable__user_active');
    let login = removableUser.querySelector('#usersTable__login').innerHTML;
    location.href = '../scriptes/deleteUser.php?remuser='+login;
};

// Кнопка назад
document.querySelector('#btnBlock__backBtn').onclick = () => location.href = '../index.php';