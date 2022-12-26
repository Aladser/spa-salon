<?php
    $users = [];         // пользователи - пароль
    $activerUser = null; // активный пользователь

    // Список всех пользователей и хэшей их паролей
    function getUsersList(){
        global $users;
        $usersDB = file('resources/users.data') ?? null;
        if($usersDB != null){
            foreach ($usersDB as $userDB){
                $line = explode(':', $userDB);
                $users[trim($line[0])] = trim($line[1]); 
            }
        }
    }
    getUsersList();

    // проверяет существование пользователя
    function existsUser($login){
        global $users;
        return array_key_exists($login, $users);
    }
    
    // аутентификация
    function checkPassword($login, $password){
        global $users;
        $hash = md5($password);
        if(existsUser($login))
            return $users[$login] === $hash;
        else
            return false; 
    }

    // получить активного пользователя
    function getCurrentUser(){
        return $activerUser;
    }
    
?>