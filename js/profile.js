window.addEventListener("load", function () {
    let navItems = document.querySelectorAll(".tab-container .tab-nav-item");
    let navContents = document.querySelectorAll(".tab-container .tab-content");

    const doc = document;
    const menuOpen = doc.querySelector(".menu");
    const menuClose = doc.querySelector(".close");
    const overlay = doc.querySelector(".overlay");

    navItems.forEach((navItem => {
        navItem.onclick = function (e) {
            let target = Number(this.getAttribute("target"));
            for (let i = 0; i < navItems.length; i++)
                navItems[i].classList.remove("active")
            this.classList.add("active");
            navContents.forEach(content => { content.style.display = "none" });
            navContents[target - 1].style.display = "block";
        }
    }));

    menuOpen.addEventListener("click", () => {
        overlay.classList.add("overlay--active");
    });

    menuClose.addEventListener("click", () => {
        overlay.classList.remove("overlay--active");
    });

});
