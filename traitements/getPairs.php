<?php

    function addPairs($idParrain,$idFilleul){
        global $conn;
        $reqFilleul = $conn->prepare("UPDATE filleuls SET id_parrain = ? WHERE id = ?");
        $reqFilleul->bindParam(1,$idParrain,PDO::PARAM_INT);
        $reqFilleul->bindParam(2,$idFilleul,PDO::PARAM_INT);
        
        $reqParrain = $conn->prepare("UPDATE parrains SET nb_filleuls = nb_filleuls + 1 WHERE id = ?");
        $reqParrain->bindParam(1,$idParrain,PDO::PARAM_INT);

        return ($reqFilleul->execute() && $reqParrain->execute());
    }

    // Établissement de la connexion à la base de données
    require_once("config.php");

    // Préparation des requêtes SQL
    $query1 = "SELECT id,nom,prenom,classe FROM parrains WHERE filiere = 'inf' ";
    $query2 = "SELECT id,nom,prenom,classe FROM filleuls WHERE filiere = 'inf' ";

    $query3 = "SELECT id,nom,prenom,classe FROM parrains WHERE filiere = 'tr' ";
    $query4 = "SELECT id,nom,prenom,classe FROM filleuls WHERE filiere = 'tr' ";

    // Exécution de la requête
    $result1 = $conn->query($query1);

    // Vérification du résultat
    if (!$result1) {
        die('Erreur dans la requête');
    }

    // Exécution de la requête
    $result2 = $conn->query($query2);

    // Vérification du résultat
    if (!$result2) {
        die('Erreur dans la requête');
    }

    // Exécution de la requête
    $result3 = $conn->query($query3);

    // Vérification du résultat
    if (!$result3) {
        die('Erreur dans la requête');
    }

    // Exécution de la requête
    $result4 = $conn->query($query4);

    // Vérification du résultat
    if (!$result4) {
        die('Erreur dans la requête');
    }

    // Mise en place des tableaux PHP
    $liste1 = $result1->fetchAll(PDO::FETCH_ASSOC);
    $liste2 = $result2->fetchAll(PDO::FETCH_ASSOC);
    $liste3 = $result3->fetchAll(PDO::FETCH_ASSOC);
    $liste4 = $result4->fetchAll(PDO::FETCH_ASSOC);


    // Mélange des tableaux
    shuffle($liste1);
    shuffle($liste2);
    shuffle($liste3);
    shuffle($liste4);

    //calcul de la taille des listes

    $length1 = count($liste1);
    $length2 = count($liste2);
    $length3 = count($liste3);
    $length4 = count($liste4);

    //on prepare le tirage au sort pour inf

    $indexParrain = 0;
    $indexFilleul = 0;
    $i = 1;

    //Tirage au sort
    $pairesInf = array();

    while ($indexFilleul < $length2) {
        if ($indexParrain == $length1)
            $indexParrain = 0;

        if(addPairs($liste1[$indexParrain]['id'],$liste2[$indexFilleul]['id'])){
            $pairesInf[$i - 1] = ['parrain' => $liste1[$indexParrain], 'filleul' => $liste2[$indexFilleul]];
            echo "Paire " . ($i) . ": " . $liste1[$indexParrain]['id'] . " - " . $liste2[$indexFilleul]['id'] . "<br>";
        }
        $i++;
        $indexParrain++;
        $indexFilleul++;
    }


    //on prepare le tirage au sort pour tr


    $indexParrain = 0;
    $indexFilleul = 0;
    $i = 1;

    $pairesTr = array();


    while ($indexFilleul < $length4) {
        if ($indexParrain == $length3)
            $indexParrain = 0;

        if(addPairs($liste3[$indexParrain]['id'],$liste4[$indexFilleul]['id']))
        {
            $pairesTr[$i - 1] = ['parrain' => $liste3[$indexParrain], 'filleul' => $liste4[$indexFilleul]];
            echo "Paire " . ($i) . ": " . $liste3[$indexParrain]['id'] . " - " . $liste4[$indexFilleul]['id'] . "<br>";
        }

        $i++;
        $indexParrain++;
        $indexFilleul++;
    }

    $retour = ['inf' => $pairesInf, 'tr' => $pairesTr];

    //echo json_encode($retour);

    /* echo "<pre>";
    var_dump($retour);
    echo "</pre>"; */

    

?>