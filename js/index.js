let callBtn = document.querySelector('.btn-call');
callBtn.addEventListener('mouseover', function(){this.value = '8 (421) 299-99-99';});
callBtn.addEventListener('mouseout', function(){this.value = 'Позвонить';});