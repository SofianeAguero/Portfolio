<?php
require 'bdd.php';
// Sous WAMP (Windows)

if(isset($_POST['email']) && isset($_POST['mdp']))
{
$query = $bdd->prepare('SELECT * FROM utilisateur where email = ? AND mot_de_passe = ?');
$query->execute(array($_POST['email'],  $_POST['mdp']));
$result = $query->fetchAll();
}

$connexion =[];
$connexion["erreur"] =[];
$connexion["reussi"] =[];
if (isset($_POST['connexion']))
 {
    if(empty($_POST['email']))
    {
     array_push($connexion['erreur'], 'Veuillez indiquer un login!');
    }
      // si mdp vide
    elseif(empty($_POST['mdp']))
    {
     array_push($connexion['erreur'], 'Veuillez indiquer votre mot de passe');
    }
      // verif du login
      elseif(empty($result))
    {
      array_push($connexion['erreur'], 'Votre identifiant est incorect !');
    }
      // verif du mdp
      elseif(empty($result))
    {
     array_push($connexion['erreur'], 'Votre mot de passe est incorect !');
    }
      else
    {
    $id = $_POST["email"];

    // sauvegarde des id de l'utilisateur
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['mdp'] = $_POST['mdp'];
    }

}  
?>
