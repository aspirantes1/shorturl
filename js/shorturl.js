document.querySelector('body').onclick = function(e) {
     modal(e);
   };

var ajax = true;
modal = function (e) {
     var i = e.target.getAttribute('name');
     var params = 'modal=modal';
     if (!ajax) return;
     switch(i) {
          case 'btn_reg':
               var login = document.getElementById('login').value;
               var pass = document.getElementById('pass').value;
               params = 'login=' + login + '&pass=' + pass;   
               i = "https://"+window.location.host+"/php/reg.php";                             
                    break;
          case 'shorturl_add':
               var url = document.getElementById('url').value;
               params = 'url=' + url;   
               i = "https://"+window.location.host+"/php/create_url.php";                             
                    break;
          case 'btn_modal_close' || 'modal_window':
               modal_window_close('modal_window');
               return location.reload();
                    break;
          case 'disconnect':
               i = "https://"+window.location.host+"/php/disconnect.php";
                    break;
          default:
               return false;
               break;
     }
     var xmlHttp = new XMLHttpRequest();
     xmlHttp.onreadystatechange = function() {
          if(xmlHttp.readyState == 4 && xmlHttp.status == 200)    {
               ajax = true;
               var j = xmlHttp.responseText;
               switch(j) {
                    case 'Авторизация успешна':
                         return window.location.href = "https://"+window.location.host+"";                   
                              break;
                    case 'Дисконнект':
                         return window.location.href = "https://"+window.location.host;                   
                              break;
                    default:
                         return modal_window_open(xmlHttp.responseText, shorturl);
                         break;
               }
               
          }
     }
     ajax = false;
     xmlHttp.open("POST", i);
     xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlHttp.send(params);
}

modal_window_open = function (i, j) {
     let div = document.createElement('div');
     let div2 = document.createElement('div');
     let btn = document.createElement('button');
          div.append(div2);
     div.className = "modal_window center";
     div.setAttribute('name', "modal_window");
     div.setAttribute('id', "modal_window");
     btn.setAttribute('name', "btn_modal_close");
     div2.className = "window_in_modal center padding025";
     btn.className = "margin025";
     btn.innerHTML = 'Подтвердить';
     div2.innerHTML = i;
     div2.append(btn);
     console.log(j);
     j.append(div);
     document.activeElement.blur();
}

modal_window_close = function(i) {
     document.getElementById(i).remove();
}

