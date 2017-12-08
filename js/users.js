/* PARTIE GESTION DES UTILISATEURS : AJOUTER / SUPPRIMER / VISUALISER LES UTILISATEURS - Utilisation de la librairie JQuery*/
/* SET serveur*/
url_server = "http://localhost/GetMyAPI";

/*AFFICHAGE LISTE DES UTILISATEURS*/
$("#affichage_users").bind('click', function (){ /*Event listener JQuery = Lorsque l'on clique sur "Afficher les utilisateurs"*/
    ajaxGet(url_server+"/users", function (reponse) { /*Requête AJAX avec endpoint /users défini dans le.htacess*/
        var position = "users"; /*variable de positionnement des données sur la page pour la fonction getUser*/
        getUser(reponse, position); /*fonction GetUser pour afficher les résultats*/
        $("#users").toggle(); /*Affiche/enleve les utilisateurs*/
    });
});

/*AFFICHAGE INFOS D'UN UTILISATEUR*/
$("#form_get_user").bind('submit', function (e){
    e.preventDefault(); /*Annule l'action du form*/
    getId = $("#get_id").val(); /*Récupération de l'ID de l'utilisateur pour l'afficher : Déclaré Globale pour ensuite gérer ses tâches*/
    ajaxGet(url_server+"/users/"+getId, function(reponse){ /*Requête AJAX avec endpoint /users/$id défini dans le.htacess*/
        var position = "user_data"; /*var correspond à l'id des balises à remplir avec les résultats*/
        getUser(reponse, position); /*fonction getUser pour afficher les résultats*/
        if(error_conf){ /*S'il n'y a pas d'erreur on affiche la partie gestion des tâches*/
        affichageUser();}
        });
});


/*AJOUT D'UN UTILISATEUR*/
var formAddUser = document.getElementById("form_add_user"); /*Jquery ne fonctionne pas avec FormData, à améliorer...*/
$(formAddUser).bind('submit', function (e){
    e.preventDefault(); /*Annule l'action du form*/
    var data = new FormData(formAddUser); // Récupération des champs du formulaire dans l'objet FormData
    ajaxPost(url_server+"/add_user.php", data, function (reponse) {   // POST Envoi des données du formulaire au serveur
        var position = "user_created"; /*var correspond à l'id des balises à remplir avec les résultats*/
        getUser(reponse, position); /*fonction getUser pour afficher les résultats*/
    });
});

/*SUPPRESSION D'UN UTILISATEUR*/
var formSupprUser = document.getElementById("form_suppr_user");
$(formSupprUser).bind('submit', function (e){
    e.preventDefault();
    var data = new FormData(formSupprUser); // Récupération des champs du formulaire dans l'objet FormData
    ajaxPost(url_server+"/suppr_user.php", data, function (reponse) {  // POST Envoi des données du formulaire au serveur
            var position = "user_suppr"; /*var correspondant à l'id des balises à remplir avec les résultats*/
            getUser(reponse, position); /*fonction getUser pour afficher les résultats*/
    });
});

/*FONCTION getUser pour afficher les résultats : Liste Utilisateurs / Utilisateur demandé / Utilisateur ajouté / Utilisateur supprimé */
function getUser(reponse, position){
        var userDatas = JSON.parse(reponse); /*Récupération de la réponse de la requête AJAX en JSON + traduction en JSON*/
        error_conf = userDatas['success']; /*Success et message en var globale, à améliorer pour ne pas trop en déclarer...*/
        message = userDatas['message'];
        if (error_conf){ /*Test: Si on a les informations alors on les affiche*/
        var datasElt = document.getElementById(position); /*Selection du div à remplir*/
        nettoyage(); /*Vide les infos ajoutées précédemment par les dernières actions s'il y en a eu*/
        userDatas['results'].forEach(function (userData) {
            var ligneElt = document.createElement("ul"); // Crée une liste à puce pour chaque élément et liste ses données
            ligneElt.innerHTML = "<li> ID : " + userData.id + "</li>" + "<li> Nom : " + userData.name + "</li>" + "<li> Email : " + userData.email + "</li>";
            datasElt.appendChild(ligneElt);
        });
    };
    $("#action_msg").html("<button>"+message+"</button>"); /*Message de confirmation ou d'erreur*/
};

/*FONCTION affichageUser : Passage de la partie Gestion des utilisateurs à la partie Gestion des tâches d'un utilisateur*/
function affichageUser(){
    $(".eltToggle").each(function() { /*Affichage des éléments de la partie Tâches initialement cachés, et on cache ceux de la partie Gestion des utilisateurs*/
        $(this).toggle();
    });
};

/*FONCTION nettoyage des div : Lorsqu'une nouvelle action est demandée, les résultats de l'action précédent sont enlevés*/
function nettoyage(){
    $(".divToReset").each(function(){
        $(this).html("");
        $("input[type=text], textarea").val(""); /*Fusionnable à améliorer*/
        $("input[type=email], textarea").val("");
    });
};
