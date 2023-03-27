<form name="form_add" method="post" action="?p=add">

    <input type="text" name="name" id="name" placeholder="Имя">

    <textarea name="comment" placeholder="Краткий комментарий"></textarea>

    <input type="submit" name="button" value="Добавить запись">

</form>
<?php

// если были переданы данные для добавления в БД

if( isset($_POST['button']) && $_POST['button']== 'Добавить запись')

{
    $HOST = 'localhost';
    $USER = 'root';
    $PASSWORD = '';
    $DATABASE = 'notebook';
// осуществляем подключение к базе данных
    $mysqli = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);



    if( mysqli_connect_errno() ) // проверяем корректность подключения

        echo 'Ошибка подключения к БД: '.mysqli_connect_error();

// формируем и выполняем SQL-запрос для добавления записи

    $sql_res=mysqli_query($mysqli, 'INSERT INTO contacts (first_name, comment) VALUES ("'.

        htmlspecialchars($_POST['name']).'", "'.

        htmlspecialchars($_POST['comment']).'")');

// если при выполнении запроса произошла ошибка – выводим сообщение

    if( mysqli_errno($mysqli) )

        echo '<div class="error">Запись не добавлена</div>'; else // если все прошло нормально – выводим сообщение

        echo '<div class="ok">Запись добавлена</div>';

}

?>
