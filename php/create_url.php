<?php

     if (empty($_POST['url'])) die('Введите url');
     if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) die('Некорректный url');

     include 'saveurl.php';


?>