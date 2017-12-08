<?php
/*CLASS MANAGER: Gestion des objets UTILISATEURS*/
class UsersManager
{
  private $_db; // Instance de PDO

/*CONSTRUCTEUR: Manager a besoin d'un accès à la BdD*/
  public function __construct($db)
  {
    $this->setDb($db);
  }

/*-------------------FONCTIONS DU MANAGER-----------------*/

/*AJOUTER UN NOUVEL UTILISATEUR*/
  public function add(User $user)
  {
    $q = $this->_db->prepare('INSERT INTO users(id, name, email) VALUES(NULL, :name, :email)');

    $q->bindValue(':name', $user->name());
    $q->bindValue(':email', $user->email(), PDO::PARAM_INT);
    $q->execute();

    return $this->_db->lastInsertId(); /*Retourne l'ID pour pouvoir afficher la personne ajoutée*/
  }

/*SUPPRIMER UN UTILISATEUR en entrant son nom*/
  public function delete($info)
  {
    $q = $this->_db->prepare('DELETE FROM users WHERE id = :id');
    $q->execute([':id' => $info]);
  }

/*COMPTER LE NOMBRE D'UTILISATEUR*/
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }

/*AFFICHER LES INFORMATIONS D'UN UTILISATEUR*/
  public function get($info)
  {
      $q = $this->_db->prepare('SELECT id, name, email FROM users WHERE id = :id');
      $q->execute([':id' => $info]);
      return $q->fetchAll();
  }

/*AFFICHER LA LISTE DES UTILISATEURS*/
  public function getList()
  {
    $users = [];

    $q = $this->_db->query('SELECT id, name, email FROM users ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = $donnees;
    }

    return $users;
  }

  /*VERIFIER L'EXISTENCE D'UN UTILISATEUR*/
  public function exists($info)
  {
    if ($info) // On veut voir si tel utilisateur ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM users WHERE id = '.$info)->fetchColumn();
    }
  }

/*FUTURES AMELIORATIONS*/
/*MODIFIER LES INFORMATIONS D'UN UTILISATEUR*/
/*  public function update(User $user)
  {
    $q = $this->_db->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');

    $q->bindValue(':name', $user->name(), PDO::PARAM_INT);
    $q->bindValue(':email', $user->email(), PDO::PARAM_INT);

    $q->execute();
  }*/

/*DEFINIR LA BDD UTILISEE*/
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }

/*------------------------FIN DES FONCTIONS MANAGER -----------------------*/
}
