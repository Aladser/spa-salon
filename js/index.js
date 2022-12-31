document.querySelector('.btn-call').addEventListener('mouseover', function(){
    this.value = '8 (421) 299-99-99';
});
document.querySelector('.btn-call').addEventListener('mouseout', function(){
    this.value = 'Позвонить';
});