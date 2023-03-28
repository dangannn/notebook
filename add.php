<?php
include './form.php';
include './connect.php';

// если были переданы данные для добавления в БД

if( isset($_POST['button']) && $_POST['button']== 'Добавить запись')

{


    if( mysqli_connect_errno() ) // проверяем корректность подключения

        echo 'Ошибка подключения к БД: '.mysqli_connect_error();

// формируем и выполняем SQL-запрос для добавления записи

    $sql_res = mysqli_query($mysqli, 'INSERT INTO `contacts` (`surname`, `name`, `lastname`, `gender`, `date`, `phone`, `location`, `email`, `comment`) VALUES ("'.
        htmlspecialchars($_POST['surname']).'", "'.
        htmlspecialchars($_POST['name']).'", "'.
        htmlspecialchars($_POST['lastname']).'", "'.
        htmlspecialchars($_POST['gender']).'", "'.
        htmlspecialchars($_POST['date']).'", "'.
        htmlspecialchars($_POST['phone']).'", "'.
        htmlspecialchars($_POST['location']).'", "'.
        htmlspecialchars($_POST['email']).'", "'.
        htmlspecialchars($_POST['comment']).'")');

// если при выполнении запроса произошла ошибка – выводим сообщение

    if(mysqli_errno($mysqli))

        echo '<div class="error">Запись не добавлена</div>'; else // если все прошло нормально – выводим сообщение

        echo '<div class="ok">Запись добавлена</div>';

}

?>
