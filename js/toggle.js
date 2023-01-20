window.addEventListener("load",function(){
    const theme = getCookie("theme");
    const toggle = document.getElementById("checkbox");
    const container = document.querySelector(".container");
    const themeToggle = document.querySelector(".theme-toggle")
    toggle.checked = false;

    if(theme != ""){
        container.classList.add("dark-theme");
        toggle.checked = true;
    }

    toggle.addEventListener("change",toggleMode);

    function toggleMode(e){
        container.classList.toggle("dark-theme");
        if(container.classList.contains("dark-theme")){
            setCookie("theme","dark-theme",30);
        }else{
            setCookie("theme","",30);
        }
    }
});