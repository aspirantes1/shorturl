<?php

unset($_SESSION['login']);
unset($_SESSION['dostup']);
setcookie("email", $login, time(), "/");
setcookie("hash", $hash, time(), "/", null, null, true);
die('Дисконнект');

?>