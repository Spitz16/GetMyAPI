<?php
/*CLASS MANAGER: Gestion des objets TACHES*/
class TasksManager
{
  private $_db; // Instance de PDO

/*CONSTRUCTEUR: Manager a besoin d'un accès à la BdD*/
  public function __construct($db)
  {
    $this->setDb($db);
  }

/*-------------------FONCTIONS DU MANAGER-----------------*/

/*AJOUTER UN NOUVEL TACHE*/
  public function add(Task $task)
  {
    $q = $this->_db->prepare('INSERT INTO tasks(id, user_id, title, description, creation_date, status) VALUES(NULL, :user_id, :title, :description, :creation_date, :status)');

    $q->bindValue(':user_id', $task->user_id());
    $q->bindValue(':title', $task->title());
    $q->bindValue(':description', $task->description(), PDO::PARAM_INT);
    $q->bindValue(':creation_date', $task->creation_date(), PDO::PARAM_INT);
    $q->bindValue(':status', $task->status(), PDO::PARAM_INT);

    $q->execute();

    return $this->_db->lastInsertId(); /*Retourne l'ID pour pouvoir afficher la tâche ajoutée*/
  }

/*SUPPRIMER UN TACHE en entrant son titre*/
  public function delete($info)
  {
    $q = $this->_db->prepare('DELETE FROM tasks WHERE id = :id');
    $q->execute([':id' => $info]);
  }

/*COMPTER LE NOMBRE DE TACHE*/
  public function count($info)
  {
      $q = $this->_db->prepare('SELECT COUNT(*) FROM tasks WHERE user_id = :id');
      $q->execute([':id'=> $info]);
      return $q->fetchColumn();
  }

/*VERIFIER L'EXISTENCE D'UNE LISTE DE TACHES POUR UN UTILISATEUR*/
  public function exists($info)
  {
    $q = $this->_db->prepare('SELECT COUNT(*) FROM tasks WHERE user_id = :user_id');
    $q->execute([':user_id' => $info]);
    return (bool) $q->fetchColumn();
  }

/*AFFICHER LES INFORMATIONS D'UNE TACHE*/
  public function get($id_user, $id_task)
  {
/*Vérifie que la tâche existe et qu'elle appartient à l'utilisateur sélectionné*/
      $q = $this->_db->prepare('SELECT id, user_id, title, description, creation_date, status FROM tasks WHERE id = :id AND user_id = :user_id');
      $q->execute([':user_id' => $id_user, ':id' => $id_task]);
      return $q->fetchAll();
  }

/*AFFICHER LA LISTE DES TACHES*/
  public function getList($info)
  {
    $tasks = [];

    $q = $this->_db->prepare('SELECT id, user_id, title, description, creation_date, status FROM tasks WHERE user_id= :id ORDER BY id');
    $q->execute([':id' => $info]);

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $tasks[] = $donnees;
    }

    return $tasks;
  }

/* ------ FUTURES AMELIORATIONS ------*/
/*MODIFIER LES INFORMATIONS D'UN TACHE*/
/*  public function update(Task $task)
  {
    $q = $this->_db->prepare('UPDATE tasks SET user_id = :user_id, title = :title, description = :description, creation_date = :creation_date, status = :status WHERE id = :id');

    $q->bindValue(':user_id', $task->user_id());
    $q->bindValue(':title', $task->title(), PDO::PARAM_INT);
    $q->bindValue(':description', $task->description(), PDO::PARAM_INT);
    $q->bindValue(':creation_date', $task->creation_date(), PDO::PARAM_INT);
    $q->bindValue(':status', $task->status(), PDO::PARAM_INT);

    $q->execute();
  }*/

/*VERIFIER L'EXISTENCE D'UNE TACHE */
/*  public function exists_task($info)
  {
      $q = $this->_db->prepare('SELECT COUNT(*) FROM tasks WHERE id = :id');
      $q->execute([':id'=> $info]);
      return (bool) $q->fetchColumn();
  }
*/

/*DEFINIR LA BDD UTILISEE*/
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }

/*------------------------FIN DES FONCTIONS MANAGER -----------------------*/
}
