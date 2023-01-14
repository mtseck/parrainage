document.getElementById("sign-up-form").addEventListener("submit", function(e) {
    e.preventDefault();
  
    let data = new FormData(this);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "/backend/register.php",true);
  
    xhr.onload = function() {
        if (this.status == 200) {
            console.log(this.response)          
        } else {
          console.log(this.response)          
        }
    }
    
    xhr.responseType = "json";
    xhr.send(data);
    return false;
  })
  