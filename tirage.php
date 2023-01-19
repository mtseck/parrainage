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
        <h1 class="title">tirage</h1>
        <p>
            <?php

            // Établissement de la connexion à la base de données
            $mysqli = new mysqli('localhost', 'root', '', 'id20143841_codi_2023');

            // Vérification de la connexion
            if ($mysqli->connect_error) {
                die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
            }

            // Préparation des requêtes SQL
            $query1 = "SELECT * FROM parrains";
            $query2 = "SELECT * FROM filleuls";

            // Exécution de la requête
            $result1 = $mysqli->query($query1);

            // Vérification du résultat
            if (!$result1) {
                die('Erreur dans la requête (' . $mysqli->errno . ') ' . $mysqli->error);
            }

            // Exécution de la requête
            $result2 = $mysqli->query($query2);

            // Vérification du résultat
            if (!$result2) {
                die('Erreur dans la requête (' . $mysqli->errno . ') ' . $mysqli->error);
            }

            // Mise en place des tableaux PHP
            $liste1 = array();
            $liste2 = array();

            // Remplissage des tableaux avec les données de la requête
            while ($row = $result1->fetch_assoc()) {
                $liste1[] = $row['id'];
            }

            while ($row = $result2->fetch_assoc()) {
                $liste2[] = $row['id'];
            }

            // Mélange des tableaux
            shuffle($liste1);
            shuffle($liste2);

            //added: calcul de la taille des listes

            $length1 = count($liste1);
            $length2 = count($liste2);

            $indexParrain = 0;
            $indexFilleul = 0;
            $i = 1;

            //modified: Tirage au sort

            while ($indexFilleul < $length2) {
                if($indexParrain == $length1) $indexParrain = 0;
                echo "Paire " . ($i) . ": " . $liste1[$indexParrain] . " - " . $liste2[$indexFilleul] . "<br>";
                $i++;
                $indexParrain++;
                $indexFilleul++;
            }
            // for ($i = 0; $i < count($liste1); $i++) {
            //     echo "Paire " . ($i + 1) . ": " . $liste1[$i] . " - " . $liste2[$i] . "<br>";
            // }

            // Fermeture de la connexion
            $mysqli->close();

            ?>
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