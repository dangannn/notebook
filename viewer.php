<?php
function getFriendsList($type, $page)

{
    include './connect.php';

    if (mysqli_connect_errno()) // проверяем корректность подключения

        return 'Ошибка подключения к БД: ' . mysqli_connect_error();

// формируем и выполняем SQL-запрос для определения числа записей
    $sql_res = mysqli_query($mysqli, 'SELECT COUNT(*) FROM contacts');
// проверяем корректность выполнения запроса и определяем его результат
     $row =  mysqli_fetch_row($sql_res);

    if (!mysqli_errno($mysqli) && $row) {
        if (!$TOTAL = $row[0])      // если в таблице нет записей

            return 'В таблице нет данных'; // возвращаем сообщение

        $PAGES = ceil($TOTAL / 10); // вычисляем общее количество страниц


        if ($page >= $TOTAL) // если указана страница больше максимальной

            $page = $TOTAL - 1; // будем выводить последнюю страницу

// формируем и выполняем SQL-запрос для выборки записей из БД

        $sql = 'SELECT * FROM contacts ORDER BY '.$type.' LIMIT ' . $page*10 . ', 10';
        $sql_res = mysqli_query($mysqli, $sql);
        $ret = '<table>'; // строка с будущим контентом страницы

        while ($row = mysqli_fetch_assoc($sql_res)) // пока есть записи

        {
            // выводим каждую запись как строку таблицы

            $ret .= '
                <tr>
                    <td>' . $row['id'] . '</td>

                    <td>' . $row['surname'] . '</td>

                    <td>' . $row['name'] . '</td>
                    
                     <td>' . $row['lastname'] . '</td>

                    <td>' . $row['gender'] . '</td>

                    <td>' . $row['date'] . '</td>
                    
                     <td>' . $row['phone'] . '</td>

                    <td>' . $row['location'] . '</td>
                    
                    <td>' . $row['email'] . '</td>

                    <td>' . $row['comment'] . '</td>
                </tr>
                ';

        }

        $ret .= '
</table>'; // заканчиваем формирование таблицы с контентом


        if ($PAGES > 1) // если страниц больше одной – добавляем пагинацию

        {

            $ret .= '
<div class="pages" id="pages">'; // блок пагинации

            for ($i = 0; $i < $TOTAL; $i++) // цикл для всех страниц пагинации

                if ($i != $page) // если не текущая страница

                    $ret .= '<a class="pages__link" href="?p=viewer&pg=' . $i . '">' . ($i + 1) . '</a>'; else // если текущая страница

                    $ret .= '<span>' . ($i + 1) . '</span>';

            $ret .= '
</div>';

        }
        return $ret;          // возвращаем сформированный контент
    }

// если запрос выполнен некорректно

    return 'Неизвестная ошибка'; // возвращаем сообщение

}

