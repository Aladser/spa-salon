let callBtn = document.querySelector('.btn-call');
callBtn.addEventListener('mouseover', function(){this.value = '8 (421) 299-99-99';});
callBtn.addEventListener('mouseout', function(){this.value = 'Позвонить';});
// подсчет временного интервала в днях, часах, минутах, секундах
function formatTimeInterval(time){
    const formatInterval = new Map();
    formatInterval.set('days', parseInt(Math.floor(time/86400)));
    formatInterval.set('hours', parseInt(Math.floor(time%86400/3600)));
    formatInterval.set('minutes', parseInt(Math.floor(time%86400%3600/60)));
    formatInterval.set('seconds', parseInt(Math.floor(time%86400%3600%60)));
    return formatInterval;
}