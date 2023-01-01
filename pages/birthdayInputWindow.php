<?php session_start() ?>

<section id='birthdayInputSection' class='modal modal_active'>
    <div class="modal__content">
        <button class="modal__close-button">x</button>
        <h1 class="modal__title">Введите вашу дату рождения</h1>
        <form method='POST' class='modal__body'>
            <input type="date" name='birthday' name class='modal__birthday'>
            <input type="submit" class='modal__btn' id='send-btn' disabled value="Отправить">
        </form>
    </div>
</section>