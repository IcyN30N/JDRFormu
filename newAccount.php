<?php
  session_start();
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <title>Créa de compte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <section class="container-fluid">
        <div class="row">
          <form name="newAccount" method="post" action="">
            <label>Login</label>
            <input type="text" placeholder="Juniper" name="userLogin">
            <label>Password</label>
            <input type="text" placeholder="not something too easy" name="userPwd">
            <label>Confirm your password</label>
            <input type="text" placeholder="same password" name="userPwdConfirm">
            <label>Email</label>
            <input type="email" placeholder="juniper@jdr.com" name="userMail">
            <label></label>
            <select name="preferredLangage">
              <option selected value="Fr">FR</option>
              <option value="Eng">ENG</option>
            </select>
            <button type="submit" name="newAccount">S'inscrire</button>
          </form>
        </div>
    </section>

    <?php
      if(isset($_POST['newAccount'])) {
        // stockage des données rentrées et sécurisation via htmlspecialchars
        $newUserLogin = htmlspecialchars($_POST['userLogin']);
        $newUserPwd = htmlspecialchars($_POST['userPwd']);
        $newUserPwdConfirm = htmlspecialchars($_POST['userPwdConfirm']);
        $newUserMail = htmlspecialchars($_POST['userMail']);
        $newUserLang = htmlspecialchars($_POST['preferredLangage']);

        // on demande à php de tenter la connexion à la bdd via PDO si les 2 mots de passe saisis sont identiques sinon...
        try {
        if($newUserPwd == $newUserPwdConfirm && $newUserLogin !== $newUserPwd) {
          // on se connecte à la base de données avec l'objet PDO
          $bdd = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');

          // on prépare la requête (création d'un compte utilisateur)
          $reqCreateAccount = $bdd->prepare('INSERT INTO membres(login, password, email, language) VALUES(:login, :password, :email, :language)');
          // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
          $reqCreateAccount->execute(array(
            'login' => $newUserLogin,
            'password' => $newUserPwd,
            'email' => $newUserMail,
            'language' => $newUserLang
          ));

          // on affiche un message pour signifier le succès de la création de compte à l'utilisateur/ice.
          echo"SUCCESS ! <br> Le compte utilisateur a bien été créé !";
          $reqCreateAccount->closeCursor();
          // on vérifie que le login n'est pas identique au mot de passe
        } elseif ($newUserLogin == $newUserPwd) {
          echo "Votre mot de passe doit être différent de votre login !";
        } else {
          // ou un message d'erreur.
          echo "Vous devez saisir 2 fois le même mot de passe !";
            }
          // on affiche un message d'erreur pour l'utilisateur/rice s'il y a eu une erreur lors de l'exécution.
          } catch(Exception $erreur) {
            die("Malheureusement, nous avons rencontré une erreur : ".$erreur->getMessage());
          }
      }
     ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="JS/jdrscript.js"></script>

</body>
</html>
