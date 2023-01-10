<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/icon.png">
        <link rel="stylesheet" href="../css/admin.css">
        <title>Панель администратора</title>
    </head>
    <body>
        <header><h3 class='tableTitle'>Список пользователей</h3></header>
        <section>
            <?php include '../scriptes/DBControl.php' ?>
            <table class='usersTable'>
                <tr><th>Пользователь</th><th>Пароль</th></tr>
                <?php
                    foreach($dbCtrl->getUsersList() as $key => $value){
                        echo "<tr class='usersTable__user'>";
                        echo "<td>$key</td><td>$value</td>";
                        echo '</tr>';
                    }
                ?>
            </table>
            <div class='btnBlock'>
                <input type="button" class='btnBlock__btn' id='addBtn' name='add' value="Добавить" disabled>
                <input type="submit" class='btnBlock__btn' id='deleteBtn' name='delete' value="Удалить" disabled>
            </div>
        </section>
        <script type='text/javascript' src='../js/admin.js'></script>
    </body>
</html>