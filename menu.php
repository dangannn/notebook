<div id="menu">
    <?php

    // если нет параметра меню – добавляем его

    if (!isset($_GET['p'])) {
        $_GET['p'] = 'view';
    }

    echo '<a href="./?p=viewer"'; // первый пункт меню

    if ($_GET['p'] == 'viewer') // если он выбран

        echo ' class="selected"'; // выделяем его

    echo '>Просмотр</a>';

    echo '<a href="./?p=add"'; // второй пункт меню

    if ($_GET['p'] == 'add') echo ' class="selected"';
    echo '>Добавить</a>';


    if ($_GET['p'] == 'viewer')    //если был выбран первый пунт меню

    {

    }
    echo '<a href="./?p=edit"'; // второй пункт меню

    if ($_GET['p'] == 'edit') echo ' class="selected"';
    echo '>Изменить</a>';

    echo '<a href="./?p=delete"'; // второй пункт меню

    if ($_GET['p'] == 'delete') echo ' class="selected"';
    echo '>Удалить</a>';
    ?>



</div>


<?php
echo '
<div id="submenu">'; // выводим подменю


echo '<a href="./?p=viewer&sort=id "'; // первый пункт подменю

if (!isset($_GET['sort']) || $_GET['sort'] == 'id') echo ' class="selected"';

echo '>По-умолчанию</a>';

echo '<a href="./?p=viewer&sort=second_name"'; // второй пункт подменю

if (isset($_GET['sort']) && $_GET['sort'] == 'second_name') echo ' class="selected"';

echo '>По фамилии</a>';

echo '
</div>';
?>
