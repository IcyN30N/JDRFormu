<?php

  class Database {
    // propriétés

    // constructeur
    public function __construct() {

    }

    // getters

    //setters

    // méthodes

    // ---- Méthodes de Création ---- //

    public function createNewMember($login, $pass, $mail, $lang ) {
      // on prépare la requête (création d'un compte utilisateur)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $reqCreateAccount = $infoDeCo->prepare('INSERT INTO membres(login_membre, mdp_membre, email_membre, langue_pref_membre) VALUES(:login, :password, :email, :language)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreateAccount->execute(array(
        'login' => $login,
        'password' => $pass,
        'email' => $mail,
        'language' => $lang
      ));
      $reqCreateAccount->closeCursor();
    }

    public function createNewCharacter($maker, $nom, $genre, $classe, $age, $element, $objets) {
      // on prépare la requête (création d'un nouveau personnage)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      $reqCreatePerso = $infoDeCo->prepare('INSERT INTO personnages(id_crea, nom_perso, genre_perso, classe_perso, age_perso, element_perso, objets_perso) VALUES( :maker, :nom_p, :genre_p, :classe_p, :age_p, :element_p, :objets_p)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreatePerso->execute(array(
        'maker' => $maker,
        'nom_p' => $nom,
        'genre_p' => $genre,
        'classe_p' => $classe,
        'age_p' => $age,
        'element_p' => $element,
        'objets_p' =>$objets
      ));
      $reqCreatePerso->closeCursor();
    }

    public function createNewCity($maker, $nom, $taille, $environnement, $attrait) {
      // on prépare la requête (création d'une nouvelle ville)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      $reqCreateCity = $infoDeCo->prepare('INSERT INTO villes(id_crea, nom_ville, taille_ville, environnement_ville, attrait_ville) VALUES(:maker, :nom_v, :taille_v, :environnement_v, :attrait_v)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreateCity->execute(array(
        'maker' => $maker,
        'nom_v' => $nom,
        'taille_v' => $taille,
        'environnement_v' => $environnement,
        'attrait_v' => $attrait
      ));
      $reqCreateCity->closeCursor();
    }

    public function createNewEvent($type, $evenement) {
      // on prépare la requête (création d'un nouvel évènement)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $reqCreateEvent = $infoDeCo->prepare('INSERT INTO evenements(type, evenement) VALUES(:type, :evenement)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreateEvent->execute(array(
        'type' => $type,
        'evenement' => $evenement
      ));
      $reqCreateEvent->closeCursor();
    }


    // ---- Méthodes de Modification ---- //

    public function databaseChange($tableToTarget, $newDatasArray) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      switch ($tableToTarget) {
        case 'membres':
          $reqUpdateMember = $infoDeCo->prepare('UPDATE membres set mdp_membre = :newPassword, email_membre = :newEmail, langue_pref_membre = :newLanguage WHERE login_membre = :userLogin');
          $reqUpdateMember->execute(array(
            'newPassword' => $newDatasArray[0],
            'newEmail' => $newDatasArray[1],
            'newLanguage' => $newDatasArray[2],
            'userLogin' => $_SESSION['login']
          ));
          $reqUpdateMember->closeCursor();
          break;
        case 'personnages':
        // à compléter plus tard avec une variable contenant de quoi sélectionner un perso ( son id !)
          break;
        case 'villes':
        // à compléter plus tard avec une variable contenant de quoi sélectionner une ville ( son id !)
          # code...
          break;
        case 'evenements':
        // à compléter plus tard avec une variable contenant de quoi sélectionner un évent ( son id !)
          # code...
          break;
        default:
          # code...
          break;
      }
    }

    // ---- Méthodes de XXXX---- //

    public function selectContentGenerator($contentToGenerate) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      switch ($contentToGenerate) {
        case 'classe':
          $req = $infoDeCo->query('SELECT * FROM classes ORDER BY id_classe');
          $options = "";
          while($donnees = $req->fetch()) {
            $options .= "<option value=" . $donnees['id_classe'] . ">" . $donnees['classe'] . "</option>";
          }
          $req->closeCursor();
          return $options;
          break;

        case 'element':
          $req = $infoDeCo->query('SELECT * FROM elements ORDER BY id_element');
          $options = "";
          while($donnees = $req->fetch()) {
            $options .= "<option value=" . $donnees['id_element'] . ">" . $donnees['element'] . "</option>";
          }
          $req->closeCursor();
          return $options;
            break;

        case 'taille':
          $req = $infoDeCo->query('SELECT * FROM tailles ORDER BY id_taille');
          $options = "";
          while($donnees = $req->fetch()) {
            $options .= "<option value=" . $donnees['id_taille'] . ">" . $donnees['taille'] . "</option>";
          }
          $req->closeCursor();
          return $options;
            break;

        case 'env':
          $req = $infoDeCo->query('SELECT * FROM environnements ORDER BY id_environnement');
          $options = "";
          while($donnees = $req->fetch()) {
            $options .= "<option value=" . $donnees['id_environnement'] . ">" . $donnees['environnement'] . "</option>";
          }
          $req->closeCursor();
          return $options;
            break;

        case 'atout':
          $req = $infoDeCo->query('SELECT * FROM attraits ORDER BY id_attrait');
          $options = "";
          while($donnees = $req->fetch()) {
            $options .= "<option value=" . $donnees['id_attrait'] . ">" . $donnees['attrait'] . "</option>";
          }
          $req->closeCursor();
          return $options;
            break;
      }
    }

    public function loginCheck($loginToCheck) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $req = $infoDeCo->prepare('SELECT mdp_membre, id_membre FROM membres WHERE login_membre = :login');
      $req->execute(array(
        'login' => $loginToCheck
      ));
      $donnees = $req->fetch();
      $_SESSION['id'] = $donnees['id_membre'];
      $_POST['refPass'] = $donnees['mdp_membre'];
      $req->closeCursor();
    }

    public function listAll($whatShouldIListToday) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      switch ($whatShouldIListToday) {
        case 'personnages':
          $req = $infoDeCo->query('SELECT * FROM personnages');
          while($donnees = $req->fetch()) {
          echo "<h1>Je m'appelle ". $donnees['nom_perso'] . "</h1><br>";
          }
          $req->closeCursor();
          break;

        case 'villes':
          $req = $infoDeCo->query('SELECT * FROM villes');
          while($donnees = $req->fetch()) {
            echo "<h1> Voici la ville de ". $donnees['nom_ville'] . "</h1><br>";
          }
          $req->closeCursor();
          break;

        case 'evenements':
          $req = $infoDeCo->query('SELECT * FROM evenements');
          while($donnees = $req->fetch()) {
            echo "<h1>". $donnees['event'] . "</h1><br>";
          }
          $req->closeCursor();
          break;

        default:
          # code...
          break;
        }
    }

    public function getOneMember() {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $getMember = $infoDeCo->prepare('SELECT * FROM membres WHERE login_membre = :login');
      $getMember->execute(array(
        'login' => $_SESSION['login']
      ));
      $donneesMember = $getMember->fetch();
      $_SESSION['password'] = $donneesMember['mdp_membre'];
      $_SESSION['email'] = $donneesMember['email_membre'];
      $_SESSION['langue'] = $donneesMember['langue_pref_membre'];
    }



  }

?>
