<?php
require_once 'config.php';

$status = 0;
$message = [];

//get the form Data

$login = htmlspecialchars($_REQUEST['mail_phone']);
$passwd = md5($_REQUEST["login_pass"]);

//check the existance of the user

$smt = $conn->prepare("SELECT * FROM filleuls WHERE email = ? AND password = ? ");
$smt->bindParam(1, $login, PDO::PARAM_STR);
$smt->bindParam(2, $passwd, PDO::PARAM_STR);
if($smt->execute()){
    if ($smt->rowCount() > 0) {
        $status = 1;
    } else {
        $message[] = "Identifiant ou mot de passe incorrect";
    }
}else{
    $message[] = "Une erreur est survenue";
}



//if there's no error, connect the user

if ($status == 1) {
    session_start();
    $user = $smt->fetch();
    $_SESSION['id'] = $user['id'];
    $_SESSION['prenom'] = $user['prenom'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['telephone'] = $user['telephone'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['classe'] = $user['classe'];
    $_SESSION['filiere'] = $user['filiere'];
    $_SESSION['id_parrain'] = $user['id_parrain'];
    $_SESSION['passwd'] = $user['password'];
}

//feedback to the js script

$res = ["success" => $status, "message" => $message];

echo json_encode($res);
