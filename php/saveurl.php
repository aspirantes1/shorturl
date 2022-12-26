<?php
include 'autor.php';

class saveurl {

     private function original($data, $post) {
          $code['short'] = generateCode();
          foreach ($data as $log) {
               if ($post == $log['url']) {
                    $code['short'] = $log['short'];
                    $code ['duble'] = true;
                    return $code;
               }
               if ($code['short'] == $log['short']) {
                    $code['short'] = generateCode();
                    return original($data);
               }
          }
          $code ['duble'] = false;
          return $code;
     }
     public function saveurl($post){
          if (empty($_SESSION['login'])) $_SESSION['login'] = 'anonim';
               mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
               ini_set('error_reporting', E_ALL);
               ini_set('display_errors', 1);
               ini_set('display_startup_errors', 1);

          $connection = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 

          function generateCode($length=6) {
               $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
               $code = "";
               $clen = strlen($chars) - 1;
               while (strlen($code) < $length) {
                       $code .= $chars[mt_rand(0,$clen)];
               }
               return $code;
          }

          $data = $connection->query('SELECT * FROM urls');

          $back = $this->original($data, $post);
          $code = $back['short'];
          $duble = $back['duble'];

          $name = $_SESSION['login'];
          unset($log);
          $data->close();

          if ($duble) echo $code and die('Ваша короткая ссылка: <a href="https://yamal.shop/'.$code.'">https://yamal.shop/'.$code.'</a>'); 
               $connection = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 
               $stmt = $connection->prepare("INSERT INTO urls (name, url, short, date) VALUES (?, ?, ?, ?)");
               $date = date ("d.m.y \(H:i\)");
               $stmt->bind_param('ssss', $name, $post, $code, $date);
               $stmt->execute();
               $stmt->close();
               return $code and die('Ваша короткая ссылка: <a href="https://yamal.shop/'.$code.'">https://yamal.shop/'.$code.'</a>');
     }
}

(new saveurl($_POST['url']))->saveurl();

?>