<?php

     $connection = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 
     $data = $connection->query('SELECT * FROM urls');

     foreach ($data as $log) {
          if ($_GET['get1'] == $log['short']) {
               readcount($log['ID'], $log['counts']);
               header('Location:'.$log['url']);
               die;
          }
     }

     function readcount($id, $count) {
          $connection2 = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 
          $stmt = $connection2->prepare("UPDATE urls SET counts = ? WHERE id = ?");
          if (empty($count)) $count = 0;
          $count = $count+1;
          var_dump($count);
          $stmt->bind_param('si', $count, $id);
          $stmt->execute();
          $stmt->close();
     }

     unset($log);
     $data->close();


?>