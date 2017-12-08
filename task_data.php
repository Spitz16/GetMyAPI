<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/*SETUPS: Récupérer l'ID User et de la task demandée via le GET de la requête AJAX*/
$get_id=$_GET['id'];
$get_idtask=$_GET['idtask'];

/*INFORMATIONS D'UN USER*/
/*Pas de verif sur le GET car input required*/
  $resultats = $managertasks->get($get_id, $get_idtask);

  if(!empty($resultats)) /*fonction get vérifie si la tâche appartient à l'utilisateur sinon retour variable vide*/
  {
    $retour["message"] = "Tâche numéro ".$get_idtask."";
    $retour["success"] = true;
    $retour["results"] = $resultats;
  }
  else
  {
    $retour["message"] = "Cette tâche n'existe pas ou n'appartient pas à cet utilisateur";/*Améliorations: séparer ces 2 tests...*/
    $retour["success"] = false;
  }

/* ----------- AFFICHAGE RESULTATS ------------*/

echo json_encode($retour);
?>
