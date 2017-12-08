<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/*SETUPS*/
$create_name = $_POST['name']; /*Récupération du nom et de l'email via un post*/
$create_email = $_POST['email'];

/*Pas de vérification sur les posts car input required utilisés + type email et text */
  $user = new User([
    'name' => $create_name,
    'email' => $create_email,
  ]);

  $user_id = $manager->add($user); /*Ajout à la Bdd*/

  if(!empty($user_id)){ /*Si l'ajout a fonctionné*/
    $retour["message"] = "Utilisateur ".$user_id." ajouté";
    $resultats = $manager->get($user_id);
    $retour["results"] = $resultats;
    $retour["success"] = true;
  }else{ /*Si l'ajout n'a pas marché (pb connexion bdd ou autre)*/
    $retour["message"] = "Problème serveur : Ajout impossible";
    $retour["success"] = false;
};

echo json_encode($retour);
?>
