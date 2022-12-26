<?php
    // ******* данные *******
    $users = [
        [
            'login' => 'antonova_da',
            'password' => md5('antonova_da'),
        ],
        [
            'login' => 'tsoi_vr',
            'password' => md5('tsoi_vr'),
        ],
        [
            'login' => 'miljukov_vr',
            'password' => md5('miljukov_vr'),
        ],
        [
            'login' => 'rykalova_la',
            'password' => md5('rykalova_la'),
        ],
        [
            'login' => 'chuchui_vm',
            'password' => md5('chuchui_vm'),
        ],
        [
            'login' => 'borzenko_ys',
            'password' => md5('borzenko_ys'),
        ],
        [
            'login' => 'chuprova_sm',
            'password' => md5('chuprova_sm'),
        ],
        [
            'login' => 'putin_vv',
            'password' => md5('putin_vv'),
        ],
        [
            'login' => 'demin_dv',
            'password' => md5('demin_dv'),
        ],
        [
            'login' => 'yakovlev_ak',
            'password' => md5('yakovlev_ak'),
        ],        
    ];

    $activerUser = null;

    // Список всех пользователей и хэшей их паролей
    function getUsersList(){
        global $users;
        foreach($users as $user){ 
            $login = $user['login'];
            $password = $user['password'];
            echo "login = $login, password = $password<br>";
        }
    }

    // поиск объекта в массиве объектов
    function findObjectInArray($arr, $prop, $propValue){
        $search = array_filter($arr, fn($elem) => $elem[$prop]===$propValue);
        return count($search) != 0;
    }

    // проверяет существование пользователя
    function existsUser($login){
        global $users;
        return findObjectInArray($users, 'login', $login);
    }
    
    // аутентификация
    function checkPassword($login, $password){
        global $users;
        return findObjectInArray($users, 'password', md5($password));
    }

    // получить активного пользователя
    function getCurrentUser(){
        return $activerUser;
    }
    
?>