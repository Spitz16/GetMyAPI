<?php

/*CHARGEMENT DES CLASSES: Utilisation d'autoload pour éviter des répétitions de require*/
function chargerClasse($classe)
{
  require $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}
spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

header('Content-Type: application/json'); /*Content Type JSON*/

/*CONNEXION A LA BDD*/
try{
  $db = new PDO('mysql:host=localhost;dbname=getmytest', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
  $retour["success"] = true;
  $retour["message"] = "Connexion à la base de donnée réussie";
}
catch(Exception $e){
  $retour["success"] = false;
  $retour["message"] = "Connexion à la base de donnée impossible";
}

/*Managers des objets utilisateurs et des objets tâches*/
$manager = new UsersManager($db);
$managertasks = new TasksManager($db);
?>
