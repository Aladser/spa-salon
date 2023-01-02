<section id='loginInputSection' class='modal modal_active'>
    <div class='loginWindow'><form method="POST" action='../scriptes/auth.php'>
        <h3 class='loginWindow__header'> Авторизация</h3>

        <?php
            session_start();
            // вывод сообщения о неправильном логине или пароле
            $nouser = $_SESSION['nouser'] ?? null;
            $wrongPassword = $_SESSION['wrongpassword'] ?? null;
            if($nouser){
                echo "<div class='loginWindow__error'>Пользователь не существует</div>";
                unset($_SESSION['nouser']);
            }
            elseif($wrongPassword)
                echo "<div class='loginWindow__error'>Неверный пароль</div>";      
        ?>

        <div class='loginWindow__formRow'>
            <label for="loginInput" class='loginWindow__label'>Логин:</label>
            <input type='text' class='loginWindow__input loginWindow__loginInput' name='login' id='loginInput' autocomplete='on' value = <?= $wrongPassword || $nouser ? $_SESSION['login'] : 'antonova_da' ?> >
            <?php if($wrongPassword) unset($_SESSION['wrongpassword']) ?>
        </div> 
        <div class='loginWindow__formRow'>
            <label for="password-input" class='loginWindow__label'>Пароль:</label>
            <input type="password" class='loginWindow__input loginWindow__passwordInput' name='password' id='password-input' autocomplete='off' value= <?= $wrongPassword || $nouser ? '' : 'antonova_da' ?>>
        </div>
        <div class='loginWindow__formRow loginWindow__btnRow'> 
            <input type="submit" class='loginWindow__Btn loginWindow__loginBtn' value='Войти'> 
            <input type="button" class='loginWindow__Btn loginWindow__cancelBtn' value='Отмена'> 
        </div>
    </form></div>
</section>
