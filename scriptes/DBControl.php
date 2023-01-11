<?php
    /** Класс управления файловой БД */
    class DBControl{
        private $dbFilename; // путь к файлу БД
        private $users; // объект пользователей

        function __construct($dbFilename){
            $this->dbFilename = $dbFilename;
            $this->users =  (array) json_decode(file($this->dbFilename)[0]);
        }

        function getUsersList(){return $this->users;} // массив пользователей и их паролей из файла

        // добавить пользователя в файл DB
        function addUser($login, $password){
            $this->users[$login] = md5($password);
            file_put_contents($this->dbFilename, json_encode($this->users));
        }
        // удалить пользователя из файла БД
        function removeUser($login){
            unset($this->users[$login]);
            file_put_contents($this->dbFilename, json_encode($this->users));
        }
    
        function existsUser($login){return array_key_exists($login, $this->users);} // проверяет существование пользователя
        
        // аутентификация
        function checkPassword($login, $password){
            return $this->existsUser($login) ? $this->users[$login] === md5($password) : false;   
        }       
    }

    $dbCtrl = new DBControl('../resources/users.json');
?>