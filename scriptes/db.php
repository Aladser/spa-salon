<?php
    $users = []; // словарь 'логин - пароль'

    // сформировать массив пользователей и их паролей из файла
    function getUsersList(){
        global $users;
        $usersDB = file('../resources/users.data') ?? null;
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
        return existsUser($login) ? $users[$login] === $hash : false;   
    } 
?>