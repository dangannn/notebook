<?php
include './connect.php';


if (mysqli_connect_errno()) // если при подключении к серверу произошла ошибка

{

// выводим сообщение и принудительно останавливаем РНР-программу

    echo 'Ошибка подключения к БД: ' . mysqli_connect_error();
    exit();

}


// если были переданы данные для изменения записи в таблице

if (isset($_POST['button']) && $_POST['button'] == 'Изменить запись') {

// формируем и выполняем SQL-запрос на изменение записи с указанным id

    $sql_res = mysqli_query($mysqli, 'UPDATE contacts SET'.
                     ' name="' . htmlspecialchars($_POST['name']) . '",'.
                     ' surname="' . htmlspecialchars($_POST['surname']) . '",'.
                     ' lastname="' . htmlspecialchars($_POST['lastname']) . '",'.
                     ' gender="' . htmlspecialchars($_POST['gender']) . '",'.
                     ' date="' . htmlspecialchars($_POST['date']) . '",'.
                     ' phone="' . htmlspecialchars($_POST['phone']) . '",'.
                     ' location="' . htmlspecialchars($_POST['location']) . '",'.
                     ' email="' . htmlspecialchars($_POST['email']) . '",'.
                     ' comment="' . htmlspecialchars($_POST['comment']) . '"'.
        ' WHERE id= ' . $_GET['id'].';');
    echo 'Данные изменены';    // и выводим сообщение об изменении данных

}


$currentROW = array();            // информации о текущей записи пока нет

// если id текущей записи передано
if (isset($_GET['id']))         // (переход по ссылке или отправка формы)

{

// выполняем поиск записи по ее id
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

$sql_res = mysqli_query($mysqli, 'SELECT id, name FROM contacts');


if (!mysqli_errno($mysqli))     // если запрос успешно выполнен

{

    echo '<div class="form__wrapper" id="edit_links">';

    while ($row = mysqli_fetch_assoc($sql_res)) // перебираем все записи выборки

    {

// если текущая запись пока не найдена и ее id не передан

// или передан и совпадает с проверяемой записью

        if ($currentROW['id'] == $row['id'])

// значит в цикле сейчас текущая запись

            echo '<div class="form__item">' . $row['name'] . '</div>';                               // и выводим ее в списке

        else    // если проверяемая в цикле запись не текущая

// формируем ссылку на нее

            echo '<a class="form__item" href="?p=edit&id=' . $row['id'] . '">' . $row['name'] . '</a>';

    }

    echo '</div>';


    if ($currentROW) // если есть текущая запись, т.е. если в таблице есть записи

    {

// формируем HTML-код формы

        echo '<form class="form" name="form_edit" method="post" action="/?p=edit&id=' . $currentROW['id'] . '">
                <input class="form__input" readonly type="text" name="id" id="id" value="'. $currentROW['id'] . '">
                <input class="form__input" type="text" name="name" id="name" value="'. $currentROW['name'] . '">
                <input class="form__input" type="text" name="surname" id="surname" value="'. $currentROW['surname'] . '">
                <input class="form__input" type="text" name="lastname" id="lastname" value="'. $currentROW['lastname'] . '">
                <input class="form__input" type="text" name="gender" id="gender" value="'. $currentROW['gender'] . '">
                <input class="form__input" type="text" name="date" id="date" value="'. $currentROW['date'] . '">
                <input class="form__input" type="text" name="phone" id="phone" value="'. $currentROW['phone'] . '">
                <input class="form__input" type="text" name="location" id="location" value="'. $currentROW['location'] . '">
                <input class="form__input" type="text" name="email" id="email" value="'. $currentROW['email'] . '">
                <input class="form__input" type="text" name="comment" id="comment" value="'. $currentROW['comment'] . '">
                <input class="form__input" type="submit" name="button" value="Изменить запись"></form>';
    } else echo 'Записей пока нет';

} else                            // если запрос не может быть выполнен

    echo 'Ошибка базы данных';       // выводим сообщение об ошибке
