window.addEventListener('load', function () {
    let infosForm = document.querySelector("#info-form");

    let inputEmail = document.querySelector("#email");
    let inputTelephone = document.querySelector("#phone");

    let error = {
        email: "",
        telephone: ""
    };

    let passForm = document.querySelector("#pass-form");
    passForm.reset();

    let currentMdp = document.querySelector("#currentMdp");
    let newMdp = document.querySelector("#newMdp");

    let errorPass = {
        current: "",
        new: ""
    };

    /* Verification dynamique des champs pour le mdp */

    currentMdp.addEventListener("input", function (e) {
        let ctn = this.value;
        if (ctn.length >= 8 && ctn.length <= 20) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            errorPass.new = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            errorPass.new = "Le mot de passe doit etre compris entre 8 et 20 caracteres";
        }
    });
    newMdp.addEventListener("input", function (e) {
        let ctn = this.value;
        if (ctn.length >= 8 && ctn.length <= 20) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            errorPass.new = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            errorPass.new = "Le mot de passe doit etre compris entre 8 et 20 caracteres";
        }
    });

    /* Verification dynamique des champs pour les infos*/

    inputEmail.addEventListener("input", function (e) {
        let ctn = this.value;
        let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (ctn.match(validRegex)) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            error.email = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            error.email = "L'email n'est pas valide";
        }
    });
    inputTelephone.addEventListener("input", function (e) {
        let ctn = this.value;
        let validRegex = /(77|78|75|70|76)[0-9]{7}$/mg;
        if (ctn.match(validRegex)) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            error.telephone = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            error.telephone = "Le numero de telephone est invalide";
        }
    });

    infosForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (error.email.length == 0 && error.telephone.length == 0) {

            let fData = new FormData(infosForm);
            let file = "../traitements/modif-info-parrain.php";
            let xhr = new XMLHttpRequest();
            xhr.open("POST", file, true);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let reponse = this.response;
                    if (reponse.success == 1) {
                        error = {
                            email: "",
                            telephone: ""
                        };
                        infosForm.querySelectorAll("input").forEach(e => {
                            e.classList.remove("error");
                            e.classList.remove("success");
                        });
                        for (let i = 0; i < reponse.message.length; i++) {
                            const element = reponse.message[i];
                            Toastinette.show("success", 4000 + Math.random() * 1000, element);
                        }
                    } else {
                        for (let i = 0; i < reponse.message.length; i++) {
                            const element = reponse.message[i];
                            Toastinette.show("error", 4000 + Math.random() * 1000, element);
                        }
                    }
                }
            }
            xhr.responseType = "json";
            xhr.send(fData);
        }
    });
    passForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (errorPass.current.length == 0 && errorPass.new.length == 0) {
            let fData = new FormData(passForm);
            let file = "../traitements/modif-info-parrain.php";
            let xhr = new XMLHttpRequest();
            xhr.open("POST", file, true);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let reponse = this.response;
                    if (reponse.success == 1) {
                        errorPass = {
                            login : "",
                            password: ""
                        };
                        passForm.querySelectorAll(".input-field").forEach(e => {
                            e.classList.remove("error");
                            e.classList.remove("success");
                        });
                        passForm.reset();
                        for (let i = 0; i < reponse.message.length; i++) {
                            const element = reponse.message[i];
                            Toastinette.show("success", 4000 + Math.random() * 1000, element);
                        }
                    } else {
                        for (let i = 0; i < reponse.message.length; i++) {
                            const element = reponse.message[i];
                            Toastinette.show("error", 4000 + Math.random() * 1000, element);
                        }
                    }
                }
            }
            xhr.responseType = "json";
            xhr.send(fData);
        }
    });
});