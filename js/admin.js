const users = document.querySelectorAll('.usersTable__user');
users.forEach(user => {
    user.onclick = () => {
        if(user.className==='usersTable__user'){
            clearSelectedUser();
            user.className = 'usersTable__user usersTable__user_active';
        }
        else{
            user.className = 'usersTable__user';
        }   
    }
});

const clearSelectedUser = () => users.forEach(user => user.className = 'usersTable__user');