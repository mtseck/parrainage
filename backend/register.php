<?php
include 'config.php';

$status = 0;
$message = [];

$prenom = htmlspecialchars(strip_tags(($_REQUEST['prenom'])));
$nom = htmlspecialchars(strip_tags(($_REQUEST['nom'])));
$email = htmlspecialchars(strip_tags(($_REQUEST['email'])));
$telephone = htmlspecialchars(strip_tags(($_REQUEST['telephone'])));
$classe = htmlspecialchars(strip_tags(($_REQUEST['classe'])));
$passwd = $_REQUEST["password"];

$phone_index = array("77","78","76","75");
$classe_list = array("DSTR1B", "DSTI2A", "DSTI2B", 'DSTTR2');

$smt = $conn->prepare("SELECT * FROM parrains_inf WHERE email= ?");
$smt->execute([$email]);

if ($smt->rowCount() > 0) {
    $message[] = "Cet utilisateur existe déjà";
} else {
    if (strlen($prenom > 3)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $telephone = str_replace(' ','', $telephone);

            if (in_array(substr($telephone, 0, 2), $phone_index) and strlen($telephone) == 9) {
                if (in_array($classe, $class_list)) {
                    if (strlen($passwd) > 8) {
                        $passwd = password_hash($passwd, PASSWORD_DEFAULT);
                        $smt = $conn->prepare("INSERT INTO parrains_inf (prenom, nom, telephone, email, classe) VALUES (?, ?, ?, ?, ?, ?)");
                        $smt->execute([$prenom, $nom, $telephone, $email, $classe, $passwd]);

                        if ($smt) {
                                $status = 1;
                                $message[] = "Inscription réussi !";
                        } else {
                                $message[] = "Échec de l'inscription !";
                                $message[] += "Veuillez contacter l'admin du site";
                        }
                    }
                   
                }
            }
        }
    }
}

$res = ["success" => $success, "message" => $message];
echo json_encode($res);
?>