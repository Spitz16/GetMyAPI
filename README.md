Date de création 08/12/2017 par César GOMEZ

## Description de l'API

UTILISATION:
1. Télécharger le dossier GetMyAPI. (Le renommer "GetMyAPI" s'il se télécharge sous un autre nom)
2. Base de donnée hébergée en local ==> Importer la base de donnée dans le dossier /bdd et l'utiliser avec un serveur local type WAMP (ou modifier la connexion à la bdd dans le header.php et la variable url_server users.js).
3. Ouvrir ensuite le fichier index.html situé dans le dossier html pour lancer l'API.

BACKEND PHP from scratch

Une classe d'objets $user définie pour les utilisateurs ainsi qu'une classe $manager pour les fonctions associées.
Une classe d'objets $task définie pour les tâches ainsi qu'une classe $tasksmanager pour les fonctions associées.

Script de chaque fonctionnalité (ajout/suppression/visualisation des utilisateurs/tâches) séparé dans des fichiers PHP différents (add_user.php, suppr_user.php, users_list.php, user_data.php, add_task.php, suppr_task.php, tasks_list.php, task_data.php)

Endpoints (définis dans le .htaccess):
- users/ : renvoie la liste des utilisateurs
- users/$id/ : renvoie les informations relatives à l'utilisateur ayant pour ID $id
- users/$id/tasks : renvoie la liste des tâches définies pour l'utilisateur ayant pour ID $id
- users/$id/tasks/$id_task : renvoie les informations relatives à la tâche ayant pour ID $id

1 base de donnée créée avec 2 tables : users(ID, nom, email) et tasks(ID, user_id, title, creation_date, status, description)
Base de donnée fournie le dossier /bdd

Communication avec le FRONT en JS / AJAX output JSON, utilisation de la librairie JQuery
Fichier users.js pour gérer les utilisateurs
Fichier tasks.js pour gérer les tâches

### Ameliorations possibles

- Fusionner fonctions GetUser et GetTask
- Bloquer les failles XSS en faisant des vérifications sur les inputs
- Fusionner la vérification d'existence d'une tache / d'une liste de tache et de GET dans tasksmanager pour faire directement la vérification + get
- Améliorer l'alignement dans l'affichage des tâches et utilisateurs
- Amélioration des tests d'erreur et de l'affichage des messages d'erreur et le code pourrait traité + d'erreurs
