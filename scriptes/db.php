<?php
    $users = []; // словарь 'логин - пароль'
    $dbFileName = '../resources/users.data'; // путь к файлу DB
    $db = file($dbFileName); // файл DB
    // сформировать массив пользователей и их паролей из файла
    foreach ($db as $user){
        $line = explode(':', $user);
        $users[trim($line[0])] = trim($line[1]); 
    }

    // запись пользователя в файл DB
    function writeToDB($login, $password){
        global $dbFileName;
        $hash = md5($password);
        $str = PHP_EOL."$login : $hash";
        file_put_contents($dbFileName, $str, FILE_APPEND);
        $users[$login] = $hash;
    }

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