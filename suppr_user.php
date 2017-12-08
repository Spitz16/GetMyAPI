<?php

/*CONNEXION BDD + CHARGEMENT DES CLASSES*/
include 'header.php';

/*SETUPS*/
$suppr_id = $_POST['id'];

/*On vérifie pas le POST car input required*/
if ($manager->exists($suppr_id)) // Fonction définie dans le manager vérifiant l'existence de l'ID dans la Bdd / de l'utilisateur.
{
  $resultats = $manager->get($suppr_id);
  $manager->delete($suppr_id);
  $retour["message"] = "Utilisateur supprimé";
  $retour["success"] = true;
  $retour["results"] = $resultats;
}
else
{
  $retour["message"] = "Cet utilisateur n'existe pas";
  $retour["success"] = false;
}

echo json_encode($retour);
?>
