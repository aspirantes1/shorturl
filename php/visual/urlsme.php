<div class='grid aligncontentcenter' style="justify-items: center;">
     <div class='grid marginauto background h100' style="max-width: 50rem; align-items: center; box-sizing: border-box;">
          <div class="center relative padding025 outline margin025 windowgain" id='author'>


<?php

$connection = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 
$data = $connection->query('SELECT * FROM urls');
 
foreach($data as $log) {

     if (isset($_SESSION['login']) and $log['name'] == $_SESSION['login']) {
?>

               <span><?php echo $log['url'].' - '.'<a href="https://yamal.shop/'.$log['short'].'">https://yamal.shop/'.$log['short'].'</a>';?></span>
               <span><?php echo '<b>'.($log['counts'] ?? 0).'</b> переход (ов)';?></span>
               </br>

<?php
     }
}
?>
          </div>
     </div>
</div>
