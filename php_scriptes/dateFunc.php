<?php
    // получить текущее время
    function getDateNowInSeconds(){
        $time = time();
        return mktime(0,0,0,date('m', $time),date('d', $time),date('Y', $time));
    }
    // переводит интервал времени в секундах в часы-минуты-секунды
    function getFormatTimeInterval($time){
        $interval['days'] = intval(floor($time/86400));
        $interval['hours'] = intval(floor($time%86400/3600));
        $interval['minutes'] = intval(floor($time%86400%3600/60));
        $interval['seconds'] = intval(floor($time%86400%3600%60));
        return $interval;
    }
?>