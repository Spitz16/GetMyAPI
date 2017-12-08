<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/*SETUPS: Améliroations possibles: Faire des RegExp pour vérifier le formats des données (date, email...)*/
$user_id = $_GET['user_id'];
$created_title = $_POST['title'];
$created_date = $_POST['creation_date'];
$created_description = $_POST['description'];
$created_status = $_POST['status'];


/*Pas de vérification sur les posts car input required utilisés + type email et text */

  $task = new Task([
    'user_id' => $user_id,
    'title' => $created_title,
    'creation_date' => $created_date,
    'description' => $created_description,
    'status' => $created_status
  ]);

  /*On ajoute la tâche et on récupère son ID pour l'afficher*/
  $task_id = $managertasks->add($task);

  if(!empty($task_id)){ /*Si l'ajout a fonctionné*/
    $retour["message"] = "Tâche ".$task_id." ajoutée";
    $resultats = $managertasks->get($user_id, $task_id); /*On récupère les infos de la task ajoutée via la fonction get de la classe taskmanager*/
    $retour["results"] = $resultats;
    $retour["success"] = true;
}
  else{ /*Si l'ajout n'a pas marché (pb connexion bdd ou autre)*/
    $retour["message"] = "Problème serveur : Ajout impossible";
    $retour["success"] = false;
};

/* ----------- AFFICHAGE RESULTATS ------------*/

echo json_encode($retour);
?>
