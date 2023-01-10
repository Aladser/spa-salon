const users = document.querySelectorAll('.usersTable__user');
const deleteBtn = document.querySelector('#deleteBtn');

users.forEach(user => {
    user.onclick = () => {
        if(user.className==='usersTable__user'){
            clearSelectedUser();
            user.className = 'usersTable__user usersTable__user_active';
            deleteBtn.disabled = false;
        }
        else{
            user.className = 'usersTable__user';
            deleteBtn.disabled = true;
        }   
    }
});

const clearSelectedUser = () => users.forEach(user => user.className = 'usersTable__user');