window.addEventListener('load', function () {
    let cible = document.body.getAttribute("cible");
    let signUpForm = document.querySelector(".sign-up-form");
    signUpForm.reset();

    let inputPrenom = document.querySelector("input[name=prenom]");
    let inputNom = document.querySelector("input[name=nom]");
    let inputEmail = document.querySelector("input[name=email]");
    let inputTelephone = document.querySelector("input[name=telephone]");
    let inputClasse = document.querySelector("select[name=classe]");
    let inputPassword = document.querySelector("input[name=password]");

    let error = {
        prenom: "",
        nom: "",
        email: "",
        telephone: "",
        classe: "",
        password: ""
    };

    let signInForm = document.querySelector(".sign-in-form");
    signInForm.reset();

    let inputMailPhone = document.querySelector("input[name=mail_phone]");
    let inputLoginPass = document.querySelector("input[name=login_pass]");

    let errorLogin = {
        login: "",
        password: ""
    };

    /* Verification dynamique des champs pour la connexion */

    inputMailPhone.addEventListener("input", function (e) {
        let ctn = this.value;
        let validMailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (ctn.match(validMailRegex)) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            errorLogin.login = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            errorLogin.login = "Le login est incorrect";
        }
    });
    inputLoginPass.addEventListener("input", function (e) {
        let ctn = this.value;
        if (ctn.length >= 8 && ctn.length <= 20) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            errorLogin.password = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            errorLogin.password = "Le mot de passe doit etre compris entre 8 et 20 caracteres";
        }
    });

    /* Verification dynamique des champs pour l'inscription*/

    inputPrenom.addEventListener("input", function (e) {
        let ctn = this.value;
        if (ctn.length > 3 && ctn.length <= 30) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            error.prenom = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            error.prenom = "Le prenom doit etre compris entre 4 et 30 caracteres";
        }
    });
    inputNom.addEventListener("input", function (e) {
        let ctn = this.value;
        if (ctn.length > 1 && ctn.length <= 20) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            error.nom = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            error.nom = "Le nom doit etre compris entre 2 et 20 caracteres";
        }
    });
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
    inputPassword.addEventListener("input", function (e) {
        let ctn = this.value;
        if (ctn.length >= 8 && ctn.length <= 20) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            error.password = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            error.password = "Le mot de passe doit etre compris entre 8 et 20 caracteres";
        }
    });
    inputClasse.addEventListener("change", function (e) {
        let ctn = this.value;
        if (ctn.length > 4 && ctn.length <= 12) {
            this.parentNode.classList.remove("error");
            this.parentNode.classList.add("success");
            error.classe = "";
        } else {
            this.parentNode.classList.remove("success");
            this.parentNode.classList.add("error");
            error.classe = "Cette classe n'est pas valide"
        }
    });

    signUpForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (error.nom.length == 0 && error.prenom.length == 0 && error.classe.length == 0 && error.email.length == 0 && error.telephone.length == 0 && error.password.length == 0) {
            let fData = new FormData(signUpForm);
            let file = (cible == "parrains") ? "../traitements/registerParrain.php" : "../traitements/registerFilleul.php";
            let xhr = new XMLHttpRequest();
            xhr.open("POST", file, true);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let reponse = this.response;
                    if (reponse.success == 1) {
                        error = {
                            prenom: "",
                            nom: "",
                            email: "",
                            telephone: "",
                            classe: "",
                            password: ""
                        };
                        signUpForm.querySelectorAll(".input-field").forEach(e => {
                            e.classList.remove("error");
                            e.classList.remove("success");
                        });
                        signUpForm.reset();
                        Toastinette.show("success", 4000 + Math.random() * 1000, " Inscription reussie ! ");
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
    signInForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (errorLogin.login.length == 0 && errorLogin.password.length == 0) {
            let fData = new FormData(signInForm);
            let file = (cible == "parrains") ? "../traitements/loginParrain.php" : "../traitements/loginFilleul.php";
            let xhr = new XMLHttpRequest();
            xhr.open("POST", file, true);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let reponse = this.response;
                    if (reponse.success == 1) {
                        errorLogin = {
                            login : "",
                            password: ""
                        };
                        signInForm.querySelectorAll(".input-field").forEach(e => {
                            e.classList.remove("error");
                            e.classList.remove("success");
                        });
                        signInForm.reset();
                        let time = 2000 + Math.random() * 1000;
                        Toastinette.show("success", time, " Connexion reussie ! ");
                        Toastinette.show("info", time, "redirection en cours ...");
                        setTimeout(()=>window.location.replace("profile.php"),time);
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