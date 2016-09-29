<?php
  session_start();
  require_once("Database.class.php");
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="">
  <title>Modification <?= $_SESSION['login']  ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta lang="fr">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
  <section class="container-fluid">
    <div class="row">
      <?php
        if(isset($_POST['UserInfoForm']) && $_POST['newPassword'] !== $_SESSION['login']) {
          $Numhiel = new Database;
          $Numhiel->getOneMember();
          var_dump($_SESSION);
          $tableToTarget = "membres";
          //$newUserInfos = [$_SESSION['password'] , $_SESSION['email'] , $_SESSION['langue']];
          $newUserInfos = [];
          if($_POST['newPassword'] !== '' && $_POST['newPassword'] !== $_SESSION['login']) {
            $newPassword = htmlspecialchars($_POST['newPassword']);
            // sécurisation du password
            $optionCost = ['cost'=>12,];
            $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, $optionCost);
            // il faut faire l'envoi vers la BDD
            echo $newHashedPassword;
            $newUserInfos = [$newHashedPassword, $_SESSION['email'], $_SESSION['langue']];
            $Numhiel->databaseChange($tableToTarget, $newUserInfos);
          }
          if($_POST['newMail'] !== '') {
            $newMail = htmlspecialchars($_POST['newMail']);
            echo $newMail;
            $newUserInfos = [$_SESSION['password'], $newMail, $_SESSION['langue']];
            $Numhiel->databaseChange($tableToTarget, $newUserInfos);
          }
          if($_POST['newPrefLang'] !== '') {
            $newPrefLang = $_POST['newPrefLang'];
            echo $newPrefLang;
            $newUserInfos = [$_SESSION['password'], $_SESSION['email'], $newPrefLang];
            $Numhiel->databaseChange($tableToTarget, $newUserInfos);
          }
          var_dump($_POST);
        } elseif(isset($_POST['UserInfoForm']) && $_POST['newPassword'] == $_SESSION['login']) {
          echo "<h1>le mot de passe doit être différent du login !!</h1>";
        }
       ?>
      <?php
        if(isset($_SESSION['login'])) {
          echo('
          <form name="UserInfoForm" class="col-lg-12" method="post">
            <label class="col-lg-6 col-md-6">password</label>
            <input type="text" name="newPassword" placeholder="monMotDePasse" class="col-lg-6 col-md-6">
            <label class="col-lg-6">email</label>
            <input type="email" name="newMail" placeholder="juniper@jdr.com" class="col-lg-6">
            <label class="col-lg-6">language</label>
            <select class="col-lg-6" name="newPrefLang">
              <option value="" selected></option>
              <option value="FR">FR</option>
              <option value="EN">EN</option>
            </select>
            <button type="submit" name="UserInfoForm">Sauvegarder mes modifications</button>
          </form>
          ');
        } else {
            echo "<h1 col-lg-12 text-center>Accès interdit !<h1>";
        }
      ?>
    </div>
  </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="JS/jdrscript.js"></script>
</body>
</html>
