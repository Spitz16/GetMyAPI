<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/*SETUPS*/
$user_id = $_GET['user_id']; /*Récupération de l'ID du user supprimé dans le lien de la requête (afin d'afficher la tâche supprimée)*/
$task_id = $_POST['id_suppr']; /*Récupération de l'ID de la tâche à supprimer via le post*/

/*Pas de verif d'existence car input required + fonction get vérifie si la task existe pour cet utilisateur*/
$resultats = $managertasks->get($user_id, $task_id); /*On récupère la tâche avant suppression pour l'afficher la tâche supprimée (=confirmation)*/

if(!empty($resultats)){
  $managertasks->delete($task_id); /*Suppression de la tâche*/
  $retour["message"] = "Tâche supprimée";
  $retour["success"] = true;
  $retour["results"] = $resultats;
}
else{
  $retour["success"] = false;
  $retour["message"] = "Cette tâche n'existe pas ou n'appartient pas à cet utilisateur";/*Améliorations: séparer ces 2 tests...*/
}

/* ----------- AFFICHAGE RESULTATS ------------*/
echo json_encode($retour);
?>
