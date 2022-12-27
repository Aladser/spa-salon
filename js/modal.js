let closeBtn = document.querySelector('.modal__close-button');
let modalWindow = document.querySelector('.modal');
let sendBtn = document.querySelector('.modal__send-btn');

closeBtn.addEventListener('click', () => modalWindow.className = 'modal');
sendBtn.addEventListener('click', () => modalWindow.className = 'modal');