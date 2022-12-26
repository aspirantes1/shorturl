<div class='grid aligncontentcenter' style="justify-items: center;">
     <div class='grid marginauto background h100' style="max-width: 50rem; align-items: center; box-sizing: border-box;">
          <div class="center relative padding025 outline margin025 windowgain" id='author'>
               <form novalidate class="grid" onsubmit="event.preventDefault()">
                         <strong align='center'>Ваш логин: </br><?php echo $_SESSION['login'];?></br></br></strong>
                         <button class="button" name="disconnect" class=''>Отключиться</button>
               </form>
          </div>
     </div>
</div>