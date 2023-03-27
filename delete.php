<?php
$HOST = 'localhost';
$USER = 'root';
$PASSWORD = '';
$DATABASE = 'notebook';
// осуществляем подключение к базе данных
$mysqli = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);


if (mysqli_connect_errno()) // если при подключении к серверу произошла ошибка

{

// выводим сообщение и принудительно останавливаем РНР-программу

    echo 'Ошибка подключения к БД: ' . mysqli_connect_error();
    exit();

}


// если были переданы данные для изменения записи в таблице

if (isset($_POST['button']) && $_POST['button'] == 'Удалить') {

// формируем и выполняем SQL-запрос на изменение записи с указанным id

    $sql_res = mysqli_query($mysqli, 'DELETE FROM contacts WHERE id=' . $_GET['id']);

    echo 'Данные удалены';    // и выводим сообщение об изменении данных

}


$currentROW = array();            // информации о текущей записи пока нет

// если id текущей записи передано
if (isset($_GET['id']))         // (переход по ссылке или отправка формы)

{

// выполняем поиск записи по ее id
    var_dump($_GET['id']);
    $sql_res = mysqli_query($mysqli,

        'SELECT * FROM contacts WHERE id=' . $_GET['id'] . ' LIMIT 0, 1');

    $currentROW = mysqli_fetch_assoc($sql_res); // информация сохраняется

}

if (!$currentROW)    // если информации о текущей записи нет или она некорректна

{

// берем первую запись из таблицы и делаем ее текущей

    $sql_res = mysqli_query($mysqli, 'SELECT * FROM contacts LIMIT 0, 1');

    $currentROW = mysqli_fetch_assoc($sql_res);

}


// формируем и выполняем запрос для получения требуемых полей всех записей таблицы

$sql_res = mysqli_query($mysqli, 'SELECT id, first_name FROM contacts');


if (!mysqli_errno($mysqli))     // если запрос успешно выполнен

{

    echo '<div id="delete_links">';

    while ($row = mysqli_fetch_assoc($sql_res)) // перебираем все записи выборки

    {

// если текущая запись пока не найдена и ее id не передан

// или передан и совпадает с проверяемой записью

        if ($currentROW['id'] == $row['id'])

// значит в цикле сейчас текущая запись

            echo '<div>' . $row['first_name'] . '</div>';                               // и выводим ее в списке

        else    // если проверяемая в цикле запись не текущая

// формируем ссылку на нее

            echo '<a href="?p=delete&id=' . $row['id'] . '">' . $row['first_name'] . '</a>';

    }

    echo '</div>';


    if ($currentROW) // если есть текущая запись, т.е. если в таблице есть записи

    {

// формируем HTML-код формы

        echo '<form name="form_delete" method="post" action="?p=delete&id=' . $currentROW['id'] . '">

<input type="text" name="name" id="name" value="' .

            $currentROW['first_name'] . '"><input type="submit" name="button" value="Удалить"></form>';

    } else echo 'Записей пока нет';

} else                            // если запрос не может быть выполнен

    echo 'Ошибка базы данных';       // выводим сообщение об ошибке
