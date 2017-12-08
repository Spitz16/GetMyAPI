<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/* LISTE DES USERS */

$resultats = $manager->getList(); /*Récupération des utilisateurs via la fonction GetList de l'obet UsersManager*/

if(!empty($resultats)){
  $retour["message"] = "".$manager->count()." Utilisateurs affichés."; /*Affichage du nombre d'utilisateurs affichés*/
}
else{
  $retour["message"] = "Pas d'utilisateurs."; /* Message d'erreur */
}

/* AFFICHAGE RESULTATS */
  $retour["success"] = true;
  $retour["results"] = $resultats;

/* ENVOI DES RESULTATS EN JSON*/
echo json_encode($retour);
?>
