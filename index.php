<?php
     mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
     ini_set('error_reporting', E_ALL);
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
 
     include 'php/autor.php';                 
     include 'php/head.php';
     include 'php/shorturl.php';
     include 'php/end.php';

?>