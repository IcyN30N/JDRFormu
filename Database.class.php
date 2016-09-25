<?php

  class Database {
    // propriétés
    //private $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
    //private $fermeture = $reqCreateAccount->closeCursor();

  public function __construct() {

  }

  // getters

  //setters

  // méthodes

  public function createNewMember($login, $pass, $mail, $lang ) {
    // on prépare la requête (création d'un compte utilisateur)
    $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
    $reqCreateAccount = $infoDeCo->prepare('INSERT INTO membres(login, password, email, language) VALUES(:login, :password, :email, :language)');
    // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
    $reqCreateAccount->execute(array(
      'login' => $login,
      'password' => $pass,
      'email' => $mail,
      'language' => $lang
    ));
    $reqCreateAccount->closeCursor();
  }

  public function loginCheck($loginToCheck) {
    $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
    $req = $infoDeCo->prepare('SELECT password FROM membres WHERE login = :login');
    $req->execute(array(
      'login' => $loginToCheck
    ));
    $donnees = $req->fetch();
    $_POST['refPass'] = $donnees['password'];
    echo"<h1>" . $_POST['refPass'] . "</h1>";
    $req->closeCursor();
  }

  }
?>
