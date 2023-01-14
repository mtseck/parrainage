document.getElementById("sign-up-form").addEventListener("submit", function(e) {
    e.preventDefault();
  
    let data = new FormData(this);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "/backend/register.php",true);
  
    xhr.onload = function() {
        if (this.status == 200) {
          //actions when register is successfull
          
        } else {
            //actions when register is not successfull
        }
    }
    
    xhr.responseType = "json";
    xhr.send(data);
    return false;
  })
  