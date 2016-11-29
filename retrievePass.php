<?php
  session_start();
  require_once('Database.class.php');
 ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Récupération du mot de passe</title>
	<meta name="" content="width=device-width, initial scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
	<section class="container-fluid text-center navigation">
    <?php
    include('header.php');
    ?>
	</section>
  <section class="container text-center">
    <div class="row login-component">
      <h1 class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Récupération de mon mot de passe :</h1>
      <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Obtenir un code de récupération : </p>
      <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left login-form" action="retrievePass.php" method="post">
        <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mon pseudo :</label>
        <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="pseudoToHelp">
        <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mon adresse mail :</label>
        <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="email" name="mailToHelp">
        <button class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg" type="submit">Valider</button>
      </form>

      <?php
        // tableau utilisé par la fonction $magicFormula afin de générer le code qui va ensuite être hashé
        $abc = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        // Fonction qui crée le code qui va être shippé par mail d'abord on génère une string qui va être composée des différents éléments d'un tableau puis hashée.
        $magicFormula = function ($toolArray) {
          $howBigShouldItBe = rand(5,20);
          $toolArraySize = count($toolArray) - 1;
          $thisIsIt = "";
          for($i = 0; $i < $howBigShouldItBe; $i++) {
            $randomIngredient = rand(0,$toolArraySize);
            $thisIsIt .= "$toolArray[$randomIngredient]";
          }
          $optionCost = ['cost'=>12,];
          $thisIsIt = password_hash($thisIsIt, PASSWORD_BCRYPT, $optionCost);
          return $thisIsIt;
        };


        $Alinhavre = new Database;
        if(isset($_POST['mailToHelp']) && isset($_POST['pseudoToHelp'])) {
          if($_POST['mailToHelp'] != "" && $_POST['pseudoToHelp'] != "") {
            $pseudo = htmlspecialchars($_POST['pseudoToHelp']);
            $mail = htmlspecialchars($_POST['mailToHelp']);

            if($Alinhavre->mailCheck($mail, $pseudo)) {
  						// ENVOI D UN MAIL
              $magicKey = $magicFormula($abc);
              $Alinhavre->retrievePwdCodeUpdate($magicKey, $pseudo, $mail);
              // à décommenter !!!! mail('orkalittlecutewolf@live.com','code', $magicKey,'Fromjdrformu@you.com');
              ?>
              <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Nous venons de vous envoyer un email.</p>
              <?php
            } else {
              ?>
              <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Nous n'avons rien trouvé avec ces informations =( </p>
              <?php
            }
          } else {
            ?>
            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">YOU SHALL NOT PASS !</p>
            <?php
            }
        }
      ?>

      <?php
        if(isset($_POST['pseudoToUseWithMagicKey']) && isset($_POST['pseudoToUseWithMagicKey'])) {
          if($_POST['pseudoToUseWithMagicKey'] != "" && $_POST['magicKeyToTest'] != "") {
            $pseudoToUseWithMagicKey = htmlspecialchars($_POST['pseudoToUseWithMagicKey']);
            $magicKeyToTest = htmlspecialchars($_POST['magicKeyToTest']);
            if($Alinhavre->retrievePwdCodeCheck($magicKeyToTest,$pseudoToUseWithMagicKey)) {

      ?>
              <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Vous avez le droit de changer de MDP</p>
              <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left login-form" action="retrievePass.php" method="post">
                <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mon pseudo :</label>
                <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="pseudoToUseWithNewPass">
                <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mon nouveau mot de passe :</label>
                <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="newPassword">
                <button class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg" type="submit">Valider</button>
              </form>
      <?php
            } else {
                ?>
                <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Nous n'avons rien trouvé avec ces informations =(</p>
                <?php ;
              }
            } else {
              ?>
              <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Pas de vide !!"</p>
              <?php
            }
          } else {
            ?>
            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Vous avez déjà un code :</p>
            <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login-form text-left" action="retrievePass.php" method="post">
              <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mon pseudo :</label>
              <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="pseudoToUseWithMagicKey">
              <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mon code de récupération :</label>
              <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" name="magicKeyToTest">
              <button class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg" type="submit">Valider</button>
            </form>
            <?php
          }

          if(isset($_POST['newPassword']) && $_POST['newPassword'] != "" && isset($_POST['pseudoToUseWithNewPass']) && $_POST['pseudoToUseWithNewPass'] != "" && $_POST['newPassword'] != $_POST['pseudoToUseWithNewPass']) {
            $pseudoToUseWithNewPass = htmlspecialchars($_POST['pseudoToUseWithNewPass']);
            $newPassword = htmlspecialchars($_POST['newPassword']);
            $optionCost = ['cost'=>12,];
            $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, $optionCost);
            $Alinhavre->passwordChange($newHashedPassword, $pseudoToUseWithNewPass);
            $Alinhavre->retrievePwdCodeClean("",$pseudoToUseWithNewPass);
            ?>
            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Votre mot de passe a bien été modifié.</p>
            <?php
          } elseif(isset($_POST['newPassword']) && $_POST['newPassword'] == $_POST['pseudoToUseWithNewPass']) {
            ?>
            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Votre login ne peux pas être identique à votre mot de passe éwè !</p>
            <?php
          }
        ?>
    </div>
	</section>

</body>

</html>
