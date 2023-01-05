/** переводит интервал времени в секундах в cутки-часы-минуты-секунды */
function formatTimeInterval(time){
    const formatInterval = new Map();
    formatInterval.set('days', parseInt(Math.floor(time/86400)));
    formatInterval.set('hours', parseInt(Math.floor(time%86400/3600)));
    formatInterval.set('minutes', parseInt(Math.floor(time%86400%3600/60)));
    formatInterval.set('seconds', parseInt(Math.floor(time%86400%3600%60)));
    return formatInterval;
}
/** получить местное время (часы:минуты) */
function getLocalHoursAndMinutes(time){
    let date = new Date(time*1000);
    let hours = date.getHours(); 
    hours = hours<10 ? `0${hours}` : hours;
    let minutes = date.getMinutes(); 
    minutes = minutes<10 ? `0${minutes}` : minutes;
    return `${hours}:${minutes}`;
}
/** получить текущую дату в секундах */
function getDateNowInSeconds(){
    let now = new Date();
    now.setHours(0);
    now.setMinutes(0);
    now.setSeconds(0);
    now.setMilliseconds(0);
    return Math.floor(Date.parse(now)/1000); 
}