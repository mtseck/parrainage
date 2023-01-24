<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:parrains/index.php");
}
if(!isset($_SESSION['is_admin'])){
    header("location:filleuls/profile.php");
}else if($_SESSION['is_admin'] == 0){
    header("location:parrains/profile.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/toggle.css">
    <script src="js/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/toastinette.css">
    <script type="text/javascript" src="js/toastinette.js"></script>
    <script type="text/javascript" src="js/cookie.js"></script>
    <style>
        .theme-toggle {
            position: fixed;
            bottom: 25px;
            top: auto;
            left: auto;
            right: 35px;
            opacity: .75;
        }
    </style>
</head>

<body class="container">
    <header>
        <a class="logo" href="parrains/profile.php"><img src="img/cody.png" alt="logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="parrains/profile.php">Profil</a></li>
                <?= ($_SESSION['is_admin']) ? "<li><a href=\"tirage.php\">Tirage</a></li>" : "" ?>
            </ul>
        </nav>
        <a class="cta" href="parrains/logout.php">Déconnexion</a>
        <p class="menu cta">Menu</p>
    </header>
    <div id="mobile__menu" class="overlay">
        <img src="img/cody.png" alt="" class="mobile-logo">
        <a class="close">&times;</a>
        <div class="overlay__content">
            <a href="parrains/profile.php">Profil</a>
            <?= ($_SESSION['is_admin']) ? "<a href=\"tirage.php\">Tirage</a>" : "" ?>
            <a href="parrains/logout.php">Déconnexion</a>
        </div>
    </div>


    <div class="content-page">
        <p>
            
        </p>
    </div>

    <div class="theme-toggle">
        <input type="checkbox" class="checkbox" id="checkbox">
        <label for="checkbox" class="label">
            <i class="fas fa-moon"></i>
            <i class='fas fa-sun'></i>
            <div class='ball'>
        </label>
    </div>

    <script src="js/profile.js"></script>
    <script src="js/toggle.js"></script>
</body>

</html>