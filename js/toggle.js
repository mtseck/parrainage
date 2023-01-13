window.addEventListener("load",function(){
    const toggle = document.getElementById("checkbox");
    const container = document.querySelector(".container");
    const themeToggle = document.querySelector(".theme-toggle")
    toggle.checked = false;

    toggle.addEventListener("change",toggleMode);

    function toggleMode(e){
        container.classList.toggle("dark-theme");
    }
});