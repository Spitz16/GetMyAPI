/* PARTIE GESTION DES TACHES UTILISATEURS : AJOUTER / SUPPRIMER / VISUALISER LES TACHES - Utilisation de la librairie JQuery*/

/*FONCTION AFFICHAGE LISTE DES TACHES DE L'UTILISATEUR*/
$("#get_tasks").bind('click', function (){ /*equivalent AddEventListener*/
    ajaxGet(url_server+"/users/"+getId+"/tasks", function (reponse) { /*Requête AJAX avec endpoint /users/$id/tasks défini dans le.htacess*/
            var position = "tasks_data"; /*var correspond à l'id des balises à remplir avec les résultats*/
            getTask(reponse, position); /*fonction getTask pour afficher les résultats*/
            $("#tasks_data").toggle();  /*Affiche/enlève les tâches*/
        });
    });

/*AFFICHAGE D'UNE TACHE DE L'UTILISATEUR*/
$("#form_get_task").bind('submit', function (e){
    e.preventDefault(); /*Annule l'action du form*/
    var getIdTask = document.getElementById("get_id_task").value; /*Récupération de l'ID de la tâche a afficher à afficher*/
    ajaxGet(url_server+"/users/"+getId+"/tasks/"+getIdTask, function(reponse){ /*Requête AJAX avec endpoint /users/$id/tasks/$task_id défini dans le.htacess*/
            var position = "task_data"; /*var correspond à l'id des balises à remplir avec les résultats*/
            getTask(reponse, position); /*fonction getTask pour afficher les résultats*/
        });
    });

/*AJOUT D'UNE TACHE A L'UTILISATEUR*/
var formAddTask = document.getElementById("form_add_task");
formAddTask.addEventListener("submit", function (e) {
    e.preventDefault(); /*Annule l'action du form*/
    var data = new FormData(formAddTask); // Récupération des champs du formulaire dans l'objet FormData
    ajaxPost(url_server+"/add_task.php?user_id="+getId, data, function (reponse) {   // POST Envoi des données du formulaire au serveur
            var position = "task_created"; /*var correspond à l'id des balises à remplir avec les résultats*/
            getTask(reponse, position); /*fonction getTask pour afficher les résultats*/
    });
});

/*SUPPRESSION D'UNE TACHE*/
var formSupprTask = document.getElementById("form_suppr_task");
formSupprTask.addEventListener("submit", function (e) {
    e.preventDefault();
    var data = new FormData(formSupprTask); // Récupération des champs du formulaire dans l'objet FormData
    ajaxPost(url_server+"/suppr_task.php?user_id="+getId, data, function (reponse) {  // POST Envoi des données du formulaire au serveur
            var position = "task_suppr"; /*var correspond à l'id des balises à remplir avec les résultats*/
            getTask(reponse, position); /*fonction getUser pour afficher les résultats*/
    });
})

/*FONCTION getTask pour afficher les résultats : Liste tâches / Tâche demandée / Tâche ajoutée / Tâche supprimée */
/*Améliorations possibles : Fusionner getTask et getUser*/
function getTask(reponse, position){
    var taskDatas = JSON.parse(reponse);
    error_conf = taskDatas['success']; /*Success et message en var globale, à améliorer pour ne pas trop en déclarer...*/
    message = taskDatas['message'];
    if (error_conf){
    var datasElt = document.getElementById(position);
    nettoyage(); /*Vide les infos ajoutées précédemment par les dernières actions s'il y en a eu*/
    taskDatas['results'].forEach(function (taskData) {
        var ligneElt = document.createElement("ul");
        ligneElt.innerHTML = "<li> ID : " + taskData.id + "</li><li> Titre : "+ taskData.title + "</li><li> Date de création : "
        + taskData.creation_date + "</li><li> Statut : " + taskData.status + "</li><li> Description : " + taskData.description + "</li>";
        datasElt.appendChild(ligneElt);
        });
    };
    $("#action_msg").html("<button>"+message+"</button>"); /*Message de confirmation ou d'erreur*/
};

/*RETOUR A LA PARTIE GESTION DES UTILISATEURS avec toggle() sur la classe "eltCaches"*/
$("#retour_user").bind('click', function (){
    affichageUser();
    $("ul").empty();
    $("input[type=text], textarea").val("");
    $("#action_msg").html("");
    });
