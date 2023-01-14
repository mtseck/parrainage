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

$class_list = array("DSTI1A", "DSTI1B", "DSTI1C", "DSTI1D", "DSTTR1A", "DSTTR1B");

//check the unicity of the user

$smt = $conn->prepare("SELECT * FROM filleuls WHERE email = ? ");
$smt->bindParam(1, $email, PDO::PARAM_STR);
$smt->execute();

if ($smt->rowCount() > 0) {
    $message[] = "Cet utilisateur existe déjà";
} else {
    if (!in_array($classe, $class_list)) {
        $message[] = "Cette Classe n'existe pas";
    }
}

//if there's no error, add user to database

if (empty($message)) {
    $filiere = ($classe == "DSTTR1A" || $classe == "DSTTR1B") ? "tr" : "inf";
    $passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $smt = $conn->prepare("INSERT INTO filleuls (prenom, nom, telephone, email, classe, filiere, password, id_parrain) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $smt->execute([$prenom, $nom, $telephone, $email, $classe, $filiere, $passwd,NULL]);
    if ($smt) {
        $status = 1;
    } else {
        $message[] = "Échec de l'inscription !";
    }
}

//feedback to the js script

$res = ["success" => $status, "message" => $message];

echo json_encode($res);
