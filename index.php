<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style.css?v=5">
    <title>Notebook</title>
</head>
<body>
<?php
require 'menu.php'; // главное меню

// модули с контентом страницы

if ($_GET['p'] == 'viewer') // если выбран пункт меню "Просмотр"

{
    include 'viewer.php'; // подключаем модуль с библиотекой функций
// если в параметрах не указана текущая страница – выводим самую первую
    if (!isset($_GET['pg']) || $_GET['pg'] < 0) $_GET['pg'] = 0;
// если в параметрах не указан тип сортировки или он недопустим
    if (!isset($_GET['sort']) || ($_GET['sort'] != 'id' && $_GET['sort'] != 'surname' &&
            $_GET['sort'] != 'birth'))
        $_GET['sort'] = 'id'; // устанавливаем сортировку по умолчанию

// формируем контент страницы с помощью функции и выводим его
    echo getFriendsList($_GET['sort'], $_GET['pg']);

} else if ($_GET['p'] == 'add') {
    include 'add.php';
} else

    if ($_GET['p'] == 'edit') {
        include 'edit.php';
    } else

        if ($_GET['p'] == 'delete') {
            include 'delete.php';
        }
?>
</body>
</html>
