<section id='loginInputSection' class='modal'>
    <div class='loginWindow'><form method="POST" action='../scriptes/auth.php'>
        <input type="button" class='loginWindow__cancelBtn' value='x'>
        <h3 class='loginWindow__header'> Авторизация</h3>
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
             
        </div>

        <p class='loginWindow__error'><?="$nouser-$wrongPassword"?></p>
    </form></div>
</section>
