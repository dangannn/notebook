<nav class="menu" id="menu">
    <?php

    // если нет параметра меню – добавляем его

    if (!isset($_GET['p'])) {
        $_GET['p'] = 'view';
    }

    echo '<a  href="./?p=viewer"'; // первый пункт меню

    if ($_GET['p'] == 'viewer') {
        echo ' class="menu__link selected"';
    } else {
        echo ' class="menu__link"';
    } // выделяем его

    echo '>Просмотр</a>';

    echo '<a href="./?p=add"'; // второй пункт меню

    if ($_GET['p'] == 'add'){
        echo ' class="menu__link selected"';
    } else {
        echo ' class="menu__link"';
    }
    echo '>Добавить</a>';


    if ($_GET['p'] == 'viewer')    //если был выбран первый пунт меню

    {

    }
    echo '<a href="./?p=edit"'; // второй пункт меню

    if ($_GET['p'] == 'edit') {
        echo ' class="menu__link selected"';
    } else {
        echo ' class="menu__link"';
    }
    echo '>Изменить</a>';

    echo '<a  href="./?p=delete"'; // второй пункт меню

    if ($_GET['p'] == 'delete'){
        echo ' class="menu__link selected"';
    } else {
        echo ' class="menu__link"';
    }
    echo '>Удалить</a>';
    ?>


</nav>


<?php
echo '
<div class="filter" id="filter">'; // выводим подменю


echo '<a href="./?p=viewer&sort=id "'; // первый пункт подменю

if (!isset($_GET['sort']) || $_GET['sort'] == 'id') {
    echo ' class="filter__option selected"';
} else {
    echo 'class="filter__option"';
}


echo '>По-умолчанию</a>';

echo '<a href="./?p=viewer&sort=surname"'; // второй пункт подменю

if (isset($_GET['sort']) && $_GET['sort'] == 'surname') {
    echo 'class="filter__option selected"';
} else {
    echo 'class="filter__option"';
}

echo '>По фамилии</a>';

echo '
</div>';
?>
