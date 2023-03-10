<?php
require_once 'config.php';

$status = 0;
$message = [];

//get the form Data

$prenom = htmlspecialchars($_REQUEST['prenom']);
$nom = htmlspecialchars($_REQUEST['nom']);
$email = htmlspecialchars($_REQUEST['email']);
$telephone = htmlspecialchars($_REQUEST['telephone']);
$classe = htmlspecialchars($_REQUEST['classe']);
$passwd = $_REQUEST["password"];

//set up a valid class list

$class_list = array("DSTI2A", "DSTI2B", "DSTI2C", "DSTTR2");

//check the unicity of the user

$smt = $conn->prepare("SELECT * FROM parrains WHERE email = ? ");
$smt->bindParam(1, $email, PDO::PARAM_STR);
$smt->execute();

if ($smt->rowCount() > 0) {
    $message[] = "Cet utilisateur existe déjà";
} else {
    if (!in_array($classe, $class_list)) {
        $message[] = "Cette classe n'existe pas";
    }
}

//if there's no error, add user to database

if (empty($message)) {
    $filiere = ($classe == "DSTTR2") ? "tr" : "inf";
    $passwd = md5($passwd);
    $smt = $conn->prepare("INSERT INTO parrains (prenom, nom, telephone, email, classe, filiere, password, nb_filleuls , is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $smt->execute([$prenom, $nom, $telephone, $email, $classe, $filiere, $passwd,0,0]);
    if ($smt) {
        $status = 1;
    } else {
        $message[] = "Échec de l'inscription !";
    }
}

//feedback to the js script

$res = ["success" => $status, "message" => $message];

echo json_encode($res);
