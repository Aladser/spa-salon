<?php
    /** Класс управления файловой БД */
    abstract class DBControl{
        private static $dbFileName = '../resources/users.data';

        private static function getDBFile(){
            return file(DBControl::$dbFileName);
        }
        // массив пользователей и их паролей из файла
        public static function getUsersList(){
            $users = [];
            $dbFile = DBControl::getDBFile();
            foreach ($dbFile as $user){
                $line = explode(':', $user);
                $users[trim($line[0])] = trim($line[1]); 
            }
            return $users;
        }
        // запись пользователя в файл DB
        public static function writeToDB($login, $password){
            $dbFile = DBControl::getDBFile();
            $hash = md5($password);
            $str = PHP_EOL."$login : $hash";
            file_put_contents(DBControl::$dbFileName, $str, FILE_APPEND);
            $users[$login] = $hash;
        }
        // проверяет существование пользователя
        public static function existsUser($login){
            return array_key_exists($login, DBControl::getUsersList());
        }
        // аутентификация
        public static function checkPassword($login, $password){
            $users = DBControl::getUsersList();
            return DBControl::existsUser($login) ? $users[$login] === md5($password) : false;   
        }       
    }
?>