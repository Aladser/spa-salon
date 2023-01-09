# Демо-версия сайта СПА-салона

Главная страница сайта СПА-салона с возможностью регистрации и авторизации пользователя 

Сделана шапка сайта с заготовкой для навигации по сайту, кнопками Вход-Выход. 
Если авторизован пользователь, показывается его имя и время входа.

В главном блоке показаны: визитка салона, услуги и акции.

В футере показана контактная информация организации

Можно войти и выйти в личный кабинет согласно записям **логин: пароль** в файле *resources/users.data*.
Если пользователь не существует, вылезет сообщение, что пользователя не существует. При неверном пароле: неверный пароль.
Данные об активности каждого пользователя хранятся в сессии.

Для удобства форма уже автозаполнена одной из учетных записей.

При первой авторизации активируется индивидуальная скидка. При последующих обновлениях страницы показывается индивидуальная скидка. Скидка сохраняется 24 часа.

При первой авторизации предлагается ввести дату рождения. Со второй авторизации ниже будет показываться счетчик дней до дня рождения.
В день рождения показывается скидка 5% на все услуги.

Есть пользователь admin, у которого нет скидок, но доступна панель администратора, которая сейчас пустая





