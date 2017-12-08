<?php
/*Class USER: Definition d'un UTILISATEUR*/
class User
{
/* Attributs */
  private $_id;
  private $_name;
  private $_email;

/*CONSTRUCTEUR : Hydratation par un tableau apportant les infos ID, nom et email*/
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

// GETTERS: Pour afficher les infos de l'utilisateur

  public function id()
  { return $this->_id;}
  public function name()
  { return $this->_name;}
  public function email()
  { return $this->_email;}

// SETTERS: Pour modifier les infos de l'utilisateur (nom de la fonction doit être "setAttribut" pour que l'hydratation marche)

  public function setId($id)
  {
    $this->_id = $id;
  }
  public function setName($name)
  {
    $this->_name = $name;
  }
  public function setEmail($email)
  {
    $this->_email = $email;
  }
}
