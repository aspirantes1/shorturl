<?php

class author {
     public function author2() {
          if (isset($_SESSION['login'])) die;

          if (isset($_COOKIE['email']) and isset($_COOKIE['hash'])) {
               $cooca = $_COOKIE['email'];
               $connection = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 
               $query = $connection->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
               $query->bind_param('s', $cooca);
               $query->execute();
               $coocdata = $query->get_result()->fetch_array(MYSQLI_ASSOC);
               $query->close();
          
               if (isset($coocdata['hash'])) {
                    if(($coocdata['hash'] !== $_COOKIE['hash']) or ($coocdata['email'] !== $_COOKIE['email']))   {
                         unset($_SESSION['login']);
                         unset($_SESSION['dostup']);
                         header('Location: http://yamal.shop/');
                    } else   {
                        $_SESSION['login'] = $coocdata['email'];
                        if ($_SESSION['login'] == 'admin') $_SESSION['dostup'] = 'reltor';
                    }
               } else {
                    if (isset($_SESSION['login'])) unset($_SESSION['login']);
                    if (isset($_SESSION['dostup'])) unset($_SESSION['dostup']);
                    header('Location: http://yamal.shop/');
               }
          } else {
          //     header('Location: http://yamal.shop/');
          }
     }
}

(new author())->author2();

?>