<?php
require_once 'config.php';
session_start();


$status = 0;
$message = [];

$email = htmlspecialchars($_REQUEST['email']);
$phone = htmlspecialchars($_REQUEST['phone']);
$currentMDP = md5($_REQUEST['currentMDP']);
$newMDP = md5($_REQUEST['newMDP']);


if (isset($_REQUEST["email"], $_REQUEST["phone"])) {
    if ($_SESSION['email'] != $email) {
        $smt = $conn->prepare("UPDATE filleuls SET email = ? WHERE id = ?");
        $smt->bindParam(1, $email, PDO::PARAM_STR);
        $smt->bindParam(2, $_SESSION['id'], PDO::PARAM_STR);
        if ($smt->execute()) {
            $status = 1;
            $message[] = "Email modifié.";
            $_SESSION['email'] = $email;
        }
    }

    if ($_SESSION['telephone'] != $phone) {
        $smt = $conn->prepare("UPDATE filleuls SET telephone = ? WHERE id = ?");
        $smt->bindParam(1, $phone, PDO::PARAM_STR);
        $smt->bindParam(2, $_SESSION['id'], PDO::PARAM_STR);
        if ($smt->execute()) {
            $status = 1;
            $message[] = "Numéro de téléphone changé.";
            $_SESSION['telephone'] = $phone;
        }
    }
}

if (isset($_REQUEST["currentMDP"], $_REQUEST["newMDP"])) {
    if ($currentMDP == $_SESSION['passwd']) {
        $smt = $conn->prepare("UPDATE filleuls SET password = ? WHERE id = ?");
        $smt->bindParam(1, $newMDP, PDO::PARAM_STR);
        $smt->bindParam(2, $_SESSION['id'], PDO::PARAM_STR);
        if ($smt->execute()) {
            $status = 1;
            $message[] = "Mot de passe changé.";
            $_SESSION['passwd'] = $newMDP;
        }
    } else {
        $message[] = "Mot de passe Incorrect.";
    }
}

$res = ["success" => $status, "message" => $message];

echo json_encode($res);
?>