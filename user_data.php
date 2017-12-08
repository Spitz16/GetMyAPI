<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/*SETUPS*/
$get_id=$_GET['id']; /*Récupération de l'ID dans l'url de la requête AJAX*/

/*INFORMATIONS D'UN USER*/
if ($manager->exists($get_id)){ // Fonction définie dans le manager vérifiant l'existence de l'ID dans la Bdd / de l'utilisateur.
  $resultats = $manager->get($get_id);
  $retour["message"] = "Informations à propos de l'utilisateur ".$get_id."";
  $retour["results"] = $resultats;
  $retour["success"] = true;
}
else{
  $retour["message"] = "Cet utilisateur n'existe pas";
  $retour["success"] = false;
}

/* ----------- AFFICHAGE RESULTATS ------------*/
echo json_encode($retour);
?>
