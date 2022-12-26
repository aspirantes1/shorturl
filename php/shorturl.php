<body class="blur5px margin0 h100 grid aligncontentcenter">
<?php 
     if (empty($_SESSION['login'])) include 'visual/author.php';
     else include 'visual/author_true.php';
?>
     <div class='grid marginauto background h100' style="justify-items: center; max-width: 50rem; align-items: center; box-sizing: border-box;">
          <div class="center relative padding025 outline margin025 windowgain" id='shorturl'>
               <div class="grid">
                    <strong align='center'>Короткий URL</br>Создать</br></br></strong>
                    <div class='flexbit'>
                         <input class="form_left w100" type="url" id='url' name="url" placeholder="Введите URL" required>
                         <span class='form_right' style="width: 15rem;" for="name">Полный URL</span>
                    </div>
</br>
                    <button name="shorturl_add" class=''>Добавить</button>
               </div>
          </div>
     </div>
</body>

<?php 
     if (empty($_SESSION['login'])) include 'visual/urlsme.php';
     else include 'visual/urlsme.php';
?>