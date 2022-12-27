let closeBtn = document.querySelector('.modal__close-button');
let modalWindow = document.querySelector('.modal');

// Закрытие модального окна ввода даты рождения на крестик
closeBtn.addEventListener('click', () => modalWindow.className='modal');