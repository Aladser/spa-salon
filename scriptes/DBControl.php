<?php
    /** Класс управления файловой БД */
    class DBControl{
        private $dbFilename;
        private $dbFile;
        private $users;

        function __construct($dbFilename){
            $this->dbFilename = $dbFilename;
            $this->dbFile = file($dbFilename);
            $this->users = $this->getUsersList();
        }

        // массив пользователей и их паролей из файла
        function getUsersList(){
            $users = [];
            foreach ($this->dbFile as $user){
                $line = explode(':', $user);
                $users[trim($line[0])] = trim($line[1]); 
            }
            return $users;
        }

        // добавить пользователя в файл DB
        function writeToDB($login, $password){
            $hash = md5($password);
            $str = PHP_EOL."$login : $hash";
            file_put_contents($this->dbFilename, $str, FILE_APPEND);
            $this->users[$login] = $hash;
        }

        // удалить пользователя из файла БД
        function removeUser($login){
            foreach($this->dbFile as $line){
                if(str_contains($line, $login)){
                    $remline = $line;
                    break;
                }
            }
            $content = file_get_contents($this->dbFilename);
            $content = str_replace($remline, '', $content);
            file_put_contents($this->dbFilename, $content);
        }

        // проверяет существование пользователя
        function existsUser($login){
            return array_key_exists($login, $this->getUsersList());
        }
        
        // аутентификация
        function checkPassword($login, $password){
            return $this->existsUser($login) ? $this->users[$login] === md5($password) : false;   
        }       
    }

    $dbCtrl = new DBControl('../resources/users.data');
?>