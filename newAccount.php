<?php
  session_start();
  require_once('Database.class.php');
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <section class="container-fluid navigation">
      <?php
        include('header.php');
      ?>
    </section>
    <section class="container">
      <div class="row login-component">
        <h1 class="col-lg-12 text-center">Inscription</h1>
        <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center login-form" name="newAccount" method="post" action="">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Login</label>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" placeholder="Juniper" name="userLogin" maxlength="20">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mot de passe</label>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" placeholder="MotDePasse" name="userPwd">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Confirmez votre mot de passe</label>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" placeholder="MotDePasse" name="userPwdConfirm">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Email</label>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="email" placeholder="juniper@jdr.com" name="userMail">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Langue</label>
          <select class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="preferredLangage">
            <option selected value="Fr">FR</option>
            <option value="Eng">ENG</option>
          </select>
          <button class="btn btn-lg" class="col-lg-6" type="submit" name="newAccount">S'inscrire</button>
        </form>

    <?php


      if(isset($_POST['newAccount'])) {
        if(isset($_POST['userLogin']) && isset($_POST['userPwd']) && isset($_POST['userPwdConfirm']) && isset($_POST['userMail']) && isset($_POST['preferredLangage']) && $_POST['userLogin'] != "" && $_POST['userPwd'] != "" && $_POST['userPwdConfirm'] != "") {
          // stockage des données rentrées et sécurisation via htmlspecialchars
          $newUserLogin = htmlspecialchars($_POST['userLogin']);
          $newUserPwd = htmlspecialchars($_POST['userPwd']);
          $newUserPwdConfirm = htmlspecialchars($_POST['userPwdConfirm']);
          $newUserMail = htmlspecialchars($_POST['userMail']);
          $newUserLang = htmlspecialchars($_POST['preferredLangage']);

          // sécurisation du password
          $optionCost = ['cost'=>12,];
          $newUserPwdHashed = password_hash($newUserPwd, PASSWORD_BCRYPT, $optionCost);

          // on demande à php de tenter la connexion à la bdd via PDO si les 2 mots de passe saisis sont identiques sinon...
          try {
          if($newUserPwd == $newUserPwdConfirm && $newUserLogin !== $newUserPwd) {
            // on crée une nouvelle instance de la classe Database.
            $Toju = new Database;
            $Toju->createNewMember($newUserLogin, $newUserPwdHashed, $newUserMail, $newUserLang);

            // on affiche un message pour signifier le succès de la création de compte à l'utilisateur/ice.
            ?>
            <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>Votre compte a bien été créé !<p>
            <?php
            // on vérifie que le login n'est pas identique au mot de passe
          } elseif ($newUserLogin == $newUserPwd) {
            ?>
            <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>Votre mot de passe doit être différent de votre login !<p>
            <?php
          } else {
            // ou un message d'erreur.
            ?>
             <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>Vous devez saisir 2 fois le même mot de passe !<p>
            <?php
              }
            // on affiche un message d'erreur pour l'utilisateur/rice s'il y a eu une erreur lors de l'exécution.
            } catch(Exception $erreur) {
              die("Malheureusement, nous avons rencontré une erreur : ".$erreur->getMessage());
            }
        } else {
          ?>
           <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>Vous devez remplir tout le formulaire !<p>
          <?php
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
