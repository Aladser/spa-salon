<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icon.png">
    <title>Панель администратора</title>
</head>
<body>
    <h3>Список пользователей</h3>
    <?php
        include '..//scriptes/db.php';
        foreach($users as $key=>$value) echo "$key:    $value<br>";
    ?>

</body>
</html>