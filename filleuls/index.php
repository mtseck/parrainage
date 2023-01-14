<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/toggle.css">
    <script src="../js/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/toastinette.css">
    <script type="text/javascript" src="../js/toastinette.js"></script>
</head>

<body cible="filleuls">
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="#" class="sign-in-form">
                    <h2 class="title">Se Connecter</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="mail" name="mail_phone" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="login_pass" required/>
                    </div>
                    <input type="submit" value="Se connecter" class="btn solid" />
                </form>
                <form action="#" class="sign-up-form">
                    <h2 class="title">S'inscrire</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Prenom" name="prenom" required />
                    </div>
                    <div class="input-field">
                        <i class="fa fa-tag"></i>
                        <input type="text" placeholder="Nom" name="nom" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required/>
                    </div>
                    <div class="input-field phone">
                        <i class="fa fa-phone"></i>
                        <i class="indicator">+221</i>
                        <input type="phone" placeholder="Telephone" name="telephone" required/>
                    </div>
                    <div class="input-field">
                        <i class="fa fa-users"></i>
                        <select name="classe" required>
                            <option value="" disabled selected>Choisir votre classe</option>
                            <option value="DSTI1A">DSTI1A</option>
                            <option value="DSTI1B">DSTI1B</option>
                            <option value="DSTI1C">DSTI1C</option>
                            <option value="DSTI1D">DSTI1D</option>
                            <option value="DSTTR1A">DSTTR1A</option>
                            <option value="DSTTR1B">DSTTR1B</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mot de passe" name="password"/>
                    </div>
                    <input type="submit" class="btn" value="S'inscrire" required/>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Pas encore inscrit ?</h3>
                    <p>
                        Veuillez vous inscrire pour avoir accès à la plateforme
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        S'inscrire
                    </button>
                </div>
                <img src="../img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Déja Inscrit ?</h3>
                    <p>
                        Veuillez vous Connecter pour avoir accès à votre espace personnel
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Se Connecter
                    </button>
                </div>
                <img src="../img/register.svg" class="image" alt="" />
            </div>
        </div>
        <div class="theme-toggle">
            <input type="checkbox" class="checkbox" id="checkbox">
            <label for="checkbox" class="label">
                <i class="fas fa-moon"></i>
                <i class='fas fa-sun'></i>
                <div class='ball'>
            </label>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script src="../js/toggle.js"></script>
    <script src="../js/validation.js"></script>
</body>

</html>