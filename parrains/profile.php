<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location:index.php");
}
?>
<?php
include_once("../traitements/config.php");
$req = $conn->prepare("SELECT * FROM filleuls WHERE id_parrain = ?");
$req->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
if ($req->execute()) {
  $filleuls = $req->fetchAll(PDO::FETCH_ASSOC);
}


$req2 = $conn->prepare("SELECT * FROM parrains WHERE id = ?");
$req2->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
if ($req2->execute()) {
  $data = $req2->fetchAll(PDO::FETCH_ASSOC)[0];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/form.css">
  <link rel="stylesheet" href="../css/profile.css">
  <link rel="stylesheet" href="../css/toggle.css">
  <script src="../js/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/toastinette.css">
  <script type="text/javascript" src="../js/toastinette.js"></script>
  <script type="text/javascript" src="../js/cookie.js"></script>
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
    <a class="logo" href="profile.php"><img src="../img/cody.png" alt="logo"></a>
    <nav>
      <ul class="nav__links">
        <li><a href="profile.php">Profil</a></li>
        <?=($_SESSION['is_admin']) ? "<li><a href=\"../tirage.php\">Tirage</a></li>" : "" ?>
      </ul>
    </nav>
    <a class="cta" href="logout.php">Déconnexion</a>
    <p class="menu cta">Menu</p>
  </header>
  <div id="mobile__menu" class="overlay">
    <img src="../img/cody.png" alt="" class="mobile-logo">
    <a class="close">&times;</a>
    <div class="overlay__content">
      <a href="profile.php">Profil</a>
      <?=($_SESSION['is_admin']) ? "<a href=\"../tirage.php\">Tirage</a>" : "" ?>
      <a href="logout.php">Déconnexion</a>
    </div>
  </div>
  <div class="page-content">
    <div class="user">
      <img src="../img/user.png" alt="user" class="user-profile" width="250">
      <h2 class="user-name">
        <?= $data['prenom'] . ' ' . $data['nom'] ?>
      </h2>
      <p class="user-more"><?= $data['classe'] . ' - ' . $data['filiere'] ?></p>
    </div>
    <div class="tab-container details">
      <ul class="tab-nav">
        <li class="tab-nav-item active" target="1">Profil</li>
        <li class="tab-nav-item" target="2">Filleuls</li>
        <li class="tab-nav-item" target="3">Paramètres</li>
      </ul>
      <div class="tab-content active" data-target="1">
        <h2 class="title">Mes informations</h2>
        <dl>
          <dt>Prenom - </dt>
          <dd>
            <?= $data['prenom'] ?>
          </dd><br>
          <br>
          <dt>Nom - </dt>
          <dd><?= $data['nom'] ?></dd><br>
          <br>
          <dt>telephone - </dt>
          <dd>
            <?= $data['telephone'] ?>
          </dd><br>
          <br>
          <dt>email - </dt>
          <dd><?= $data['email'] ?></dd><br>
          <br>
          <dt>classe - </dt>
          <dd>
            <?= $data['classe'] ?>
          </dd><br>
          <br>
          <dt>filiere - </dt>
          <dd>
            <?= $data['filiere'] ?>
          </dd><br>
          <br>
        </dl>
      </div>
      <div class="tab-content" data-target="2">
        <h2 class="title">Mes filleuls</h2>
        <?=($data['nb_filleuls'] == 0) ? "<p>Vous n'avez pas encore de filleuls</p>" : "<p>Vous avez " . $data['nb_filleuls'] . " filleul(s)</p>"; ?>
        <?php
        for ($i = 0; $i < count($filleuls); $i++) {
          ?>
          <div class="ucard">
            <h2 class="ucard-name">
              <?= $filleuls[$i]['prenom'] . ' ' . $filleuls[$i]['nom'] ?>
            </h2>
            <p class="ucard-more"><?= $filleuls[$i]['classe'] . ' - ' . $filleuls[$i]['filiere'] . ' - ' . $filleuls[$i]['telephone'] ?></p>
          </div>
        <?php
        }
        ?>
      </div>
      <div class="tab-content" data-target="3">
        <h2 class="title">Modifier mes informations</h2>
        <form class="form-container" id="info-form" method="post" action="../traitements/modif-info-parrain.php">
          <div class="form-group email-group">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="<?= $data['email'] ?>">
          </div>

          <div class="form-group phone-group">
            <label for="phone">Téléphone (mobile)</label>
            <input id="phone" type="text" name="phone" value="<?= $data['telephone'] ?>">
          </div>

          <div class="button-container">
            <button class="button" type="submit">Enregister les modifications</button>
          </div>
        </form>
        <h2 class="title">Modifier mon mot de passe</h2>
        <form class="form-container" id="pass-form" method="post" action="../traitements/modif-info-parrain.php">
          <div class="form-group email-group">
            <label for="currentMdp">Mot de passe actuel</label>
            <input id="currentMdp" type="password" name="currentMDP">
          </div>

          <div class="form-group phone-group">
            <label for="newMdp">Nouveau mot de passe</label>
            <input id="newMdp" type="password" name="newMDP">
          </div>

          <div class="button-container">
            <button class="button" type="submit">Changer</button>
          </div>
        </form>
      </div>
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

  <script src="../js/profile.js"></script>
  <script src="../js/toggle.js"></script>
  <script src="../js/validationParrain.js"></script>

</body>

</html>