<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

$get_id=$_GET['id']; /*Récupération de l'ID user dans la requête AJAX*/

/*LISTE DES TACHES*/
if($manager->exists($get_id)){ /*Fonction définie dans la classe tasksmanager pour vérifier si l'utilisateur à des tâches */
  $resultats = $managertasks->getList($get_id);
  $retour["message"] = "".$managertasks->count($get_id)." tâches affichées."; /*Affichage du nombre de tâches de l'utilisateur*/
  $retour["results"] = $resultats;
  $retour["success"] = true;
}
else{
  $retour["message"] = "Pas de tâches"; /* Message d'erreur */
  $retour["success"] = false;
}

echo json_encode($retour);
?>
