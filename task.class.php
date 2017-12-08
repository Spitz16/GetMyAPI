<?php
/*Class TASK: Definition d'une TACHE*/
class Task
{
/*Attributs*/
  private $_id;
  private $_user_id;
  private $_title;
  private $_creation_date;
  private $_status;

/*CONSTRUCTEUR : Hydratation par un tableau apportant les infos de la tâche*/
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }

  public function hydrate(array $donnees) /*Utilisation d'un foreach et de method_exists pour éviter d'écrire tous les attributs*/
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

// GETTERS: Pour afficher les infos de la tâche
  public function id()
  { return $this->_id;}
  public function user_id()
  { return $this->_user_id;}
  public function title()
  { return $this->_title;}
  public function description()
  { return $this->_description;}
  public function creation_date()
  { return $this->_creation_date;}
  public function status()
  { return $this->_status;}

// SETTERS: Pour modifier les infos de la tâche (nom de la fonction doit être "setAttribut" pour que l'hydratation marche)
  public function setId($id)
  {
    $this->_id = $id;
  }
  public function setUser_id($user_id)
  {
    $this->_user_id = $user_id;
  }
  public function setTitle($title)
  {
    $this->_title = $title;
  }
  public function setDescription($description)
  {
    $this->_description = $description;
  }
  public function setCreation_date($creation_date)
  {
    $this->_creation_date = $creation_date;
  }
  public function setStatus($status)
  {
    $this->_status = $status;
  }
}
?>
