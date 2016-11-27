<?php
  session_start();
  require_once("Database.class.php");
  if( ! (isset($_SESSION['login']) ) ) {
    header('Location: error401.html');
  } else {


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
  <section class="navigation container-fluid">
    <?php
    include('header.php');
    ?>
  </section>
  <section class="container">
    <div class="row login-component">
      <h1 class="col-lg-12 text-center">Modifier vos informations</h1>
      <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login-form" name="UserInfoForm" class="col-lg-12" method="post">
        <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">password</label>
        <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="newPassword" placeholder="MotDePasse">
        <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">email</label>
        <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="email" name="newMail" placeholder="juniper@jdr.com">
        <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">language</label>
        <select class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="newPrefLang">
          <option value="" selected></option>
          <option value="FR">FR</option>
          <option value="EN">EN</option>
        </select>
        <button class="btn btn-lg col-lg-12 col-md-12 col-sm-12 col-xs-12" type="submit" name="UserInfoForm">Enregistrer</button>
      </form>

      <?php
          if(isset($_POST['UserInfoForm']) && $_POST['newPassword'] !== $_SESSION['login']) {
            $Numhiel = new Database;
            $tableToTarget = "membres";
            //$newUserInfos = [$_SESSION['password'] , $_SESSION['email'] , $_SESSION['langue']];
            $newUserInfos = [];
            if($_POST['newPassword'] !== '' && $_POST['newPassword'] !== $_SESSION['login']) {
              $Numhiel->getOneMember();
              $newPassword = htmlspecialchars($_POST['newPassword']);
              // sécurisation du password
              $optionCost = ['cost'=>12,];
              $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, $optionCost);
              $newUserInfos = [$newHashedPassword, $_SESSION['email'], $_SESSION['langue']];
              $Numhiel->databaseChange($tableToTarget, $newUserInfos);
            }
            if($_POST['newMail'] !== '') {
              $Numhiel->getOneMember();
              $newMail = htmlspecialchars($_POST['newMail']);
              $newUserInfos = [$_SESSION['password'], $newMail, $_SESSION['langue']];
              $Numhiel->databaseChange($tableToTarget, $newUserInfos);
            }
            if($_POST['newPrefLang'] !== '') {
              $Numhiel->getOneMember();
              $newPrefLang = $_POST['newPrefLang'];
              $newUserInfos = [$_SESSION['password'], $_SESSION['email'], $newPrefLang];
              $Numhiel->databaseChange($tableToTarget, $newUserInfos);
            }
            echo "<p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>Nous avons bien pris en compte ces changements.</p>";
            unset($_SESSION['password'], $_SESSION['email']);
          } elseif(isset($_POST['UserInfoForm']) && $_POST['newPassword'] == $_SESSION['login']) {
            echo "<p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>le mot de passe doit être différent du login !!</p>";
          }

        }
      ?>
    </div>
  </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="JS/jdrscript.js"></script>
</body>
</html>
